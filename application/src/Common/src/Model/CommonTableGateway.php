<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/User for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Common\Model;

use Zend\Cache\Storage\StorageInterface;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\TableGateway\TableGateway;

class CommonTableGateway extends AbstractTableGateway
{
    protected $cache;
    protected $cache_namespace;
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function setCache($cache)
    {
        $this->cache = $cache;
        return $this;
    }
    public function removeCache()
    {
        $this->cache->removeItem($this->getCacheNamespace());
        return $this;
    }

    public function setCacheNamespace($cache_namespace = null)
    {
        $this->cache_namespace = $cache_namespace;
        return $this;
    }

    public function getCacheNamespace()
    {
        return $this->cache_namespace;
    }

    public function fetchAllBy($value, $name = "uid")
    {
        if (null!==$this->cache) {
            $cacheNamespace = sprintf("%s_%s_%s",$this->cache_namespace,$name,$value);
            if($this->cache->getItem($cacheNamespace)) {
                $result = $this->cache->getItem($cacheNamespace);
            } else {
                $result = null;
                $resultSet = $this->tableGateway->select(array($name => $value));
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
            $resultSet = $this->tableGateway->select(array($name => $value));
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
}
