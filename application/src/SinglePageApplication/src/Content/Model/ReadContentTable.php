<?php

namespace SinglePageApplication\Content\Model;

use SinglePageApplication\Content\Model\ContentModel as Model;
use Zend\Db\TableGateway\TableGateway;

class ReadContentTable
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
        return $this->tableGateway->select(function($select) use($name,$value) {
            $select->where->in($name, [$value]);
            $select->order(array('order'=>'asc'));
        });

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
        $rowset = $this->tableGateway->select(array($name => $value),'order','DESC');
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
            'block' => $item->block,
            'order' => $item->order,
            'template' => $item->template,
            'type' => $item->type,
            'content' => $item->content,
        );

        $uid = $item->uid;

        if ($uid === 0) {
            return $this->tableGateway->insert($data);
        } else {
            $data = array(
                'uid' => $item->uid,
                'content' => $item->content,
            );
            if ($this->getItem($uid)) {
                return $this->tableGateway->update($data, array('uid' => $uid));
            } else {
                throw new \Exception('Item\'s uid does not exist');
            }
        }
        return null;
    }

    public function deleteItem($uid)
    {
        $this->tableGateway->delete(array('uid' => $uid));
    }
}