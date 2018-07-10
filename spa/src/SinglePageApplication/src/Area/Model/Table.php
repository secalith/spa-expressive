<?php

namespace SinglePageApplication\Area\Model;

use Zend\Db\TableGateway\TableGateway;

class Table
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }
    public function fetchAllBy($value,$name="uid")
    {
        $select = $this->tableGateway->select(array($name => $value));
        return $select;
    }

    public function getItem($uid)
    {
        $rowset = $this->tableGateway->select(array('uid' => $uid));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $uid");
        }
        return $row;
    }

    public function fetchBy($value,$name="uid")
    {
        $rowset = $this->tableGateway->select(array($name => $value));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $value");
        }
        return $row;
    }

    public function saveItem(Model $item)
    {
        $data = array(
            'uid' => $item->uid,
            'template' => $item->template,
            'type' => $item->type,
        );

        $uid = $item->uid;
        if ($uid == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getItem($uid)) {
                $this->tableGateway->update($data, array('uid' => $uid));
            } else {
                throw new \Exception('Item\'s uid does not exist');
            }
        }
    }

    public function deleteItem($uid)
    {
        $this->tableGateway->delete(array('uid' => $uid));
    }
}