<?php

declare(strict_types=1);

namespace GeneratorXdd\Model;

use GeneratorXdd\Model\MemeTextModel;
use Zend\Db\TableGateway\TableGateway;
use Common\Model\GenerateUUIDTrait;
use Zend\Db\Sql\Select;

class MemeTextTable
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

    public function getItemByUid($uid)
    {
        $rowset = $this->tableGateway->select(array('uid' => $uid));
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
//        $resultSet->next();

        return $resultSet;
    }
    /**
     * @return \Zend\Db\ResultSet\ResultSet
     */
    public function fetchAllBy($where=[])
    {
        $resultSet = $this->tableGateway->select($where);

        $resultSet->buffer();
//        $resultSet->next();

        return $resultSet;
    }
    /**
     * @return \Zend\Db\ResultSet\ResultSet
     */
    public function fetchAllByAndOrderByDateDesc($where=[])
    {
        $select = new Select('event');
        $select->columns(['uid','site_uid','event_group','name','country','status']);
        $select->join('event_details','event_details.event_uid=event.uid','date_start','left');
        $select->order('date_start DESC');


        $rowset = $this->tableGateway->selectWith($select);

        $rowset->buffer();

        return $rowset;

        $sqlSelect = $this->tableGateway->getSql()->select();
        $sqlSelect->columns(['uid','site_uid','event_group','name','country','status'])
            ->join('event_details','event_details.event_uid=event.uid')
        ;

        $statement = $this->tableGateway->getSql()->prepareStatementForSqlObject($sqlSelect);
        $resultSet = $statement->execute();

        $resultSet->buffer();
//        $resultSet->next();

        return $resultSet;
    }

    /**
     * @param string $uid
     * @return \Page\Model\PageModel
     */
    public function getItem(string $uid) : EventModel
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

    public function saveItem(EventModel $item)
    {
        if( null === $item->getUid() || empty($item->getUid())) {
            $item->setUid($this->generateUUID());
        }

        $dateTime = new \DateTime('now');

        $data = array(
            'uid' => $item->getUid(),
            'application_uid' => $item->getApplicationUid(),
            'site_uid' => $item->getSiteUid(),
            'event_group' => $item->getEventGroup(),
            'name' => $item->getName(),
            'country' => $item->getCountry(),
            'status' => $item->getStatus(),
            'created' => $dateTime->format('Y-m-d H:i:s'),
        );

        $rowsAffected = $this->tableGateway->insert($data);


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
