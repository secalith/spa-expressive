<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Authentication\Model;

use Common\Model\CommonTableGateway as CommonTable;
use Authentication\Entity\UserEntity as Entity;
use Authentication\Model\UserModel as Model;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;

class UserTable// extends CommonTable
{
    protected $tableGateway;
    protected $cache;
    protected $cache_namespace = "spa_page";
    protected $cache_namespacee;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function listAll()
    {

        $order = "DESC";

        $sql = $this->tableGateway->getSql();
        $sqlSelect = $sql->select();
//        $sqlSelect->columns(array('column_name'));
//        $sqlSelect->join('route_routes', 'route_routes.route_uid = page.route', array(), 'inner');



        $sqlSelect->order('name' . ' ' . $order);

        $resultSet = $this->tableGateway->selectWith($sqlSelect);

        $resultSet->buffer();

        return $resultSet;
    }

    public function fetchAll()
    {
        // check if cache is present
        if (null!==$this->cache
            && null!==$this->cache->getItem($this->cache_namespace)) {
            $result = $this->cache->getItem($this->cache_namespace);
        } else {
            $resultSet = $this->tableGateway->select();
            foreach ($resultSet as $item) {
                $result[$item->getName()] = $item;
            }
            if (null!==$this->cache) {
                $this->cache->removeItem($this->cache_namespace);
                $this->cache->setItem($this->cache_namespace, $result);
            }
        }
        return $result;
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

    public function saveItem(Entity $item)
    {
        $data = array(
            'uid' => $item->getUid(),
            'name' => $item->getName(),
            'template' => $item->getTemplate(),
            'route' => $item->getRoute(),
            'route_url' => $item->getRouteUrl(),
            'page_cache' => $item->getPageCache(),
        );
        $this->tableGateway->insert($data);
    }

    public function updateItem(Entity $item)
    {

        $data = array(
            'uid' => $item->getUid(),
            'name' => $item->getName(),
            'template' => $item->getTemplate(),
            'route' => $item->getRoute(),
            'route_url' => $item->getRouteUrl(),
            'page_cache' => $item->getPageCache(),
        );

        $uid = $item->getUid();

        if (null!==$uid&&0===$uid) {
            throw new \Exception('Item\'s uid cannot be null');
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

    public function fetchBy($value, $name = "uid",$muteException=false)
    {
        $rowset = $this->tableGateway->select(array($name => $value));
        $row = $rowset->current();
        if ($muteException===false&&!$row) {
            throw new \Exception("Could not find row $value");
        }
        return $row;
    }

    public function fetchBya($value, $name = "uid",$muteException=false)
    {
        $this->cache_namespacee = $this->cache_namespace . "_by_".$name."_".$value;
        //$this->cache->removeItem($this->cache_namespacee);
        $result=null;
        // check if cache is present
        if (null!==$this->cache
            && null!==$this->cache->getItem($this->cache_namespacee)) {
//            echo 'Cache HIT<br />';
            // cache is enabled and present
            $result = $this->cache->getItem($this->cache_namespacee);
        } else {
//            echo 'Cache MISS '. $this->cache_namespacee .'<br />';
            // cache is disabled OR not present
            $resultSet = $this->tableGateway->select(array($name => $value));
            if (!empty($resultSet)) {
                foreach ($resultSet as $item) {
                    $result[$item->getName()] = $item;
                }
                if (null!==$this->cache) {
                    // cache is enabled but NOT present
                    if (null===$result) {
//                        echo 'Cache Save '. $this->cache_namespacee .'<br />';var_dump($result);
                        $this->cache->removeItem($this->cache_namespacee);
                        $this->cache->setItem($this->cache_namespacee, '');
                    } else {
//                        echo 'Cache Save '. $this->cache_namespacee .'<br />';var_dump($result);
                        $this->cache->removeItem($this->cache_namespacee);
                        $this->cache->setItem($this->cache_namespacee, $result);
                    }
                }
            } else {
//                echo 'Cache SaveE '. $this->cache_namespacee .'<br />';
                $this->cache->removeItem($this->cache_namespacee);
                $this->cache->setItem($this->cache_namespacee, '');
            }
        }
        return $result;
    }
}
