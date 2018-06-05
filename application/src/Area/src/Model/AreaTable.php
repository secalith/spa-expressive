<?php

namespace Area\Model;

use Area\Model\AreaModel;
use Zend\Db\TableGateway\TableGateway;

class Table
{
    /**
     * @var TableGateway
     */
    protected $tableGateway;

    /**
     * ProductTable constructor.
     * @param TableGateway $tableGateway
     */
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();

        $resultSet->buffer();
        $resultSet->next();

        return $resultSet;
    }

    public function getItem($uid) : AreaModel
    {
        $rowset = $this->tableGateway->select(['area_uid' => $uid]);

        return $rowset->current();
    }

    public function getItemCount($uid = null)
    {
        if ($uid===null) {
            return 0;
        }

        if (is_array($uid)) {
            $rowset = $this->tableGateway->select($uid);
        } else {
            $rowset = $this->tableGateway->select(['area_uid' => $uid]);
        }

        return $rowset->current();
    }

    public function fetchBy($value, $name = "area_uid")
    {
        $rowset = $this->tableGateway->select([$name => $value]);

        return $rowset->current();
    }

}