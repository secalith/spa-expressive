<?php

declare(strict_types=1);

namespace Area\Model;

use Common\Model\GenerateUUIDTrait;
use Area\Model\AreaModel;
use Zend\Db\TableGateway\TableGateway;

class AreaTable
{
    use GenerateUUIDTrait;

    /**
     * @var TableGateway
     */
    protected $tableGateway;

    /**
     * AreaTable constructor.
     * @param TableGateway $tableGateway
     */
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    /**
     * @return \Zend\Db\ResultSet\ResultSet
     */
    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();

        $resultSet->buffer();

        return $resultSet;
    }

    /**
     * @param string $uid
     * @return array|\ArrayObject|null
     */
    public function getItem(string $uid)
    {
        $rowset = $this->tableGateway->select(['uid' => $uid]);

        return $rowset->current();
    }

    /**
     * @param string|null $uid
     * @return array|\ArrayObject|int|null
     */
    public function getItemCount(string $uid = null)
    {
        if ($uid===null) {
            return 0;
        }

        if (is_array($uid)) {
            $rowset = $this->tableGateway->select($uid);
        } else {
            $rowset = $this->tableGateway->select(['uid' => $uid]);
        }

        return $rowset->current();
    }

    /**
     * @param $value
     * @param string $name
     * @return array|\ArrayObject|null
     */
    public function fetchBy($value, $name = "uid")
    {
        if(is_array($value)) {
            $rowset = $this->tableGateway->select($value);
        } else {
            $rowset = $this->tableGateway->select([$name => $value]);
        }

        return $rowset->current();
    }
    public function fetchAllBy($value, $name = "uid")
    {
        if(is_array($value)) {
            $rowset = $this->tableGateway->select($value);
        } else {
            $rowset = $this->tableGateway->select([$name => $value]);
        }

        return $rowset->buffer();
    }
    public function fetchAllAreasBy($value, $name = "uid")
    {
        if(is_array($value)) {
            $rowset = $this->tableGateway->select($value);
        } else {
            $rowset = $this->tableGateway->select([$name => $value]);
        }

        return $rowset->buffer();
    }

}