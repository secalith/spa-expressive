<?php

namespace Area\Model;

use Common\Model\CommonTableGateway;
use Zend\Db\TableGateway\TableGateway;

class AreaTable
{
    protected $cache_namespace = "template_model_table";

    public function fetchBy($value, $name = "uid")
    {
        if (null!==$this->cache) {
            $cacheNamespace = sprintf("%s_%s_%s",$this->cache_namespace,$name,$value);
            if($this->cache->getItem($cacheNamespace)) {
                $result = $this->cache->getItem($cacheNamespace);
            } else {
                $result = null;
                $resultSet = $this->tableGateway->select(array($name => $value));
                $this->cache->removeItem($cacheNamespace);
                $this->cache->setItem($cacheNamespace, $resultSet);
                return $resultSet->current();
            }
        } else {
            $result = null;
            $resultSet = $this->tableGateway->select(array($name => $value));
            return $resultSet->current();
        }
    }

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
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

    public function fetchAllBy($value, $name = "uid")
    {

//        $mapNamingStrategy = new MapNamingStrategy(['published' => 'isPublished']);
//        $underscoreNamingStrategy = new UnderscoreNamingStrategy();
//        $namingStrategy = new CompositeNamingStrategy([
             Extraction:
//            'isPublished'  => $mapNamingStrategy,
//            'publishedOn'  => $underscoreNamingStrategy,
//            'updatedOn'    => $underscoreNamingStrategy,
//
             Hydration:
//            'published'    => $mapNamingStrategy,
//            'published_on' => $underscoreNamingStrategy,
//            'updated_on'   => $underscoreNamingStrategy,
//        ]);


        if(null!==$this->cache) {
            $cacheNamespace = sprintf("%s_%s_%s",$this->cache_namespace,$value,$name);
            if($this->cache->getItem($cacheNamespace)) {
                $result = $this->cache->getItem($cacheNamespace);
            } else {
                $result = null;
                $resultSet = $this->tableGateway->select();
                foreach ($resultSet as $item) {
                    if(method_exists($item,"getName")) {
                        $result[$item->getName()] = $item;
                    } else {
                        $result[$item->getUid()] = $item;
                    }
                }
                $this->cache->removeItem($cacheNamespace);
                $this->cache->setItem($cacheNamespace, $result);
            }
        } else {
            $result = null;
            $resultSet = $this->tableGateway->select([$name=>$value]);
            foreach ($resultSet as $item) {
                if(method_exists($item,"getName")) {
                    $result[$item->getName()] = $item;
                } else {
                    $result[$item->getUid()] = $item;
                }
            }
        }
        return $result;
    }

    public function saveItem(NavigationModel $item)
    {
        $data = array(
            'uid' => $item->uid,
            'name' => $item->name,
            'type' => $item->type,
            'route' => $item->route,
            'location' => $item->location,
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
