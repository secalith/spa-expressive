<?php

namespace SpaPetition\Model;

use Common\Model\GerenateUUIDTrait;
use SpaPetition\Model\PetitionModel;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;

class PetitionTable
{

    use GerenateUUIDTrait;

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function listAll()
    {

        $order = "DESC";

        $sql = $this->tableGateway->getSql();
        $sqlSelect = $sql->select();


        $sqlSelect->order('created' . ' ' . $order);

        $resultSet = $this->tableGateway->selectWith($sqlSelect);

        $resultSet->buffer();

        return $resultSet;
    }

    public function getItemByUid($uid)
    {
        $rowset = $this->tableGateway->select(array('uid' => $uid));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $uid");
        }
        return $row;
    }

    public function saveItem($item)
    {
        var_dumP($item);die();
        if( null === $item->getUid() || empty($item->getUid())) {
            $item->setUid($this->generateUUID());
        }

        $dateTime = new \DateTime('now');

        $data = array(
            'uid' => $item->getUid(),
            'application_uid' => $item->getEmail(),
            'site_uid' => $item->getEmail(),
            'status' => 1,
            'created' => $dateTime->format('Y-m-d\TH:i:s.u'),
        );

        $rowsAffected = $this->tableGateway->insert($data);


        return [
            'affected' => $rowsAffected,
            'data' => $data,
        ];


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
}
