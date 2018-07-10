<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Form\Model;

use Common\Model\CommonTableGateway;
use Zend\Db\TableGateway\TableGateway;

class FormTable extends CommonTableGateway
{
    protected $cache_namespace = "form_model_table";

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function fetchAllBy($value, $name = "uid")
    {
        if(null!==$this->cache) {
            $cacheNamespace = sprintf("%s_%s_%s",$this->cache_namespace,$value,$name);
            if($this->cache->getItem($cacheNamespace)) {
                $result = $this->cache->getItem($cacheNamespace);
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
                $this->cache->removeItem($cacheNamespace);
                $this->cache->setItem($cacheNamespace, $result);
            }
        } else {
            $result = null;
            if(is_array($value)){
                $resultSet = $this->tableGateway->select($value);
            } else {
                $resultSet = $this->tableGateway->select([$name=>$value]);
            }

            if($resultSet->count() > 0) {
                foreach ($resultSet as $item) {
                    if(method_exists($item,"getName")) {
                        $result[$item->getName()] = $item;
                    } else {
                        $result[$item->getUid()] = $item;
                    }
                }
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

    public function fetchBy($value, $name = "uid")
    {
        $rowset = $this->tableGateway->select(array($name => $value), 'order', 'DESC');
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $value");
        }
        return $row;
    }

    public function saveItem(FormModel $item)
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
