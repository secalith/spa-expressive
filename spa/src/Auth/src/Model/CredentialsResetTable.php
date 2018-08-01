<?php

namespace Auth\Model;

use Common\Model\GenerateUUIDTrait;
use Common\Model\CommonTableGateway as CommonTable;
use Authentication\Entity\UserEntity as Entity;
use Authentication\Model\UserModel as Model;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;

class CredentialsResetTable
{
    use GenerateUUIDTrait;

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function getItem($uid)
    {
        $rowset = $this->tableGateway->select(array('email' => $uid));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $uid");
        }
        return $row;
    }

    public function deleteItem($uid)
    {
        $this->tableGateway->delete(array('uid' => $uid));
    }

    public function fetchBy($value, $name = "uid",$muteException=false)
    {
        $rowset = $this->tableGateway->select(array($name => $value));
        $row = $rowset->current();
        if ($muteException===false&&!$row) {
            throw new \Exception("Could not find row $value");
        }
        return $row;
    }

    public function saveItem($item)
    {
        if( null === $item->getUid()) {
            $item->setUid($this->generateUUID());
        }

        $data = $item->toArray();

        return $this->tableGateway->insert($data);
    }

}
