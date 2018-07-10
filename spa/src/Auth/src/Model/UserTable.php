<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Auth\Model;

use Common\Model\CommonTableGateway as CommonTable;
use Authentication\Entity\UserEntity as Entity;
use Authentication\Model\UserModel as Model;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;

class UserTable// extends CommonTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
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

    public function getItemBy($value, $name = "email")
    {
        $rowset = $this->tableGateway->select(array($name => $value));
        $row = $rowset->current();

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
}
