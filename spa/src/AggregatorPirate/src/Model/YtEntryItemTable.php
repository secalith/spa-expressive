<?php

declare(strict_types=1);

namespace AggregatorPirate\Model;

use AggregatorPirate\Model\YtEntryItemModel;
use Zend\Db\TableGateway\TableGateway;

class YtEntryItemTable
{
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

    /**
     * @return \Zend\Db\ResultSet\ResultSet
     */
    public function fetchAll($selector=null)
    {
        $resultSet = $this->tableGateway->select($selector);

        $resultSet->buffer();

        return $resultSet;
    }

    /**
     * @param string $uid
     * @return \Page\Model\PageModel
     */
    public function getItem(string $uid) : YtEntryItemModel
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
    public function getItemByParentUid($value, $name = "parent_uid")
    {
        if(is_array($value)) {
            $rowset = $this->tableGateway->select($value);
        } else {
            $rowset = $this->tableGateway->select([$name => $value]);
        }

        return $rowset->current();
    }

    public function saveItem(YtEntryItemModel $item)
    {
        if( null === $item->getUid() || empty($item->getUid())) {
            $item->setUid($this->generateUUID());
        }

        $dateTime = new \DateTime('now');

        $data = array(
            'uid' => $item->getUid(),
            'name' => $item->getName(),
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
