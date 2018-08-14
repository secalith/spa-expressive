<?php

declare(strict_types=1);

namespace Event\Model;

use Event\Model\EventDetailsModel;
use Zend\Db\TableGateway\TableGateway;
use Common\Model\GenerateUUIDTrait;

class EventDetailsTable
{

    use GenerateUUIDTrait;

    /**
     * @var TableGateway
     */
    protected $tableGateway;

    /**
     * PageTable constructor.
     * @param TableGateway $tableGateway
     */
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function getItemByParentUid($uid)
    {
        $rowset = $this->tableGateway->select(array('event_uid' => $uid));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $uid");
        }
        return $row;
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
     * @return \Page\Model\PageModel
     */
    public function getItem(string $uid) : EventDetailsModel
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
    public function fetchAllBy($value)
    {
        return $this->fetchBy($value);
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

    public function saveItem(EventDetailsModel $item)
    {
        if( null === $item->getUid() || empty($item->getUid())) {
            $item->setUid($this->generateUUID());
        }

        $dateTime = new \DateTime('now');

        $data = array(
            'uid' => $item->getUid(),
            'application_uid' => $item->getApplicationUid(),
            'site_uid' => $item->getSiteUid(),
            'event_uid' => $item->getEventUid(),
            'name' => $item->getName(),
            'city' => $item->getCity(),
            'city_global' => $item->getCityGlobal(),
            'language' => $item->getLanguage(),
            'date_start' => $item->getDateStart(),
            'date_finish' => $item->getDateFinish(),
            'timezone' => $item->getTimezone(),
            'event_link_external' => $item->getEventLinkExternal(),
            'event_map_external' => $item->getEventMapExternal(),
            'status' => $item->getStatus(),
            'created' => $dateTime->format('Y-m-d H:i:s'),
        );

        $rowsAffected = $this->tableGateway->insert($data);

//        var_dump($item);
//        var_dump($data);
//        var_dump($rowsAffected);
//        die();

        return [
            'affected' => $rowsAffected,
            'data' => $data,
        ];

    }

    public function updateItem($selector,$data)
    {
        $rowsAffected = $this->tableGateway->update($data, $selector);

        return [
            'affected' => $rowsAffected,
            'data' => $data,
        ];
    }
}
