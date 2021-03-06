<?php

declare(strict_types=1);

namespace PageRoute\Model;

use PageRoute\Model\RouterEntryModel;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;

class RouterTable
{
    /**
     * @var TableGateway
     */
    protected $tableGateway;

    const TABLE_NAME = 'router' ;

    /**
     * RouterTable constructor.
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
     * @return \PageRoute\Model\RouterModel
     */
    public function getItem(string $uid) : RouterEntryModel
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

    /**
     * @param $value
     * @param string $name
     * @return array|\ArrayObject|null
     */
    public function fetchItemBy($value, $name = "uid")
    {
        if(is_array($value)) {
            $rowset = $this->tableGateway->select();
//            $rowset->columns('uid');

            $rowset = $this->tableGateway->select(function(Select $select) use($value) {
                $select->columns([
                    'uid'=>'uid',
                    'parent_uid'=>'parent_uid',
                    'application_uid'=>'application_uid',
                    'site_uid'=>'site_uid',
                    'route_uid'=>'route_uid',
                    'route_url'=>'route_url',
                    'scenario'=>'scenario',
                    'controller'=>'controller',
                    'method'=>'method',
                    'attributes'=>'attributes',
                    'status'=>'status'
                ]);
                $concatJoin = sprintf("route.uid = %s.route_uid",self::TABLE_NAME);
                $select->join('route', $concatJoin,['route_name'],'left');
                $select->where($value);
            });
        } else {
            $rowset = $this->tableGateway->select([$name => $value]);
        }

        return $rowset->buffer();
    }

    public function saveItem(RouterEntryModel $item)
    {
        if( null === $item->getUid() || empty($item->getUid())) {
            $item->setUid($this->generateUUID());
        }

        $dateTime = new \DateTime('now');

        $data = array(
            'uid' => $item->getUid(),
            'parent_uid' => $item->getParentUid(),
            'application_uid' => $item->getApplicationUid(),
            'site_uid' => $item->getSiteUid(),
            'route_uid' => $item->getRouteUid(),
            'route_url' => $item->getRouteUrl(),
            'scenario' => $item->getScenario(),
            'controller' => $item->getController(),
            'status' => $item->getStatus(),
            'created' => $dateTime->format('Y-m-d H:i:s'),
        );

        $rowsAffected = $this->tableGateway->insert($data);


        return [
            'affected' => $rowsAffected,
            'data' => $data,
        ];


    }
}
