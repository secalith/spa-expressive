<?php

declare(strict_types=1);

namespace PageTemplate\Model;

use PageTemplate\Model\PageTemplateModel;
use Zend\Db\TableGateway\TableGateway;

class PageTemplateTable
{
    /**
     * @var TableGateway
     */
    protected $tableGateway;

    /**
     * TemplateTable constructor.
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
        $resultSet->next();

        return $resultSet;
    }

    /**
     * @param string $uid
     * @return \PageTemplate\Model\PageTemplateModel
     */
    public function getItem(string $uid) : PageTemplateModel
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
        $rowset = $this->tableGateway->select([$name => $value]);

        return $rowset->current();
    }

    public function saveItem(PageTemplateModel $item)
    {
        if( null === $item->getUid() || empty($item->getUid())) {
            $item->setUid($this->generateUUID());
        }

        $dateTime = new \DateTime('now');

        $data = array(
            'uid' => $item->getUid(),
            'name' => $item->getName(),
            'route_uid' => $item->getRouteUid(),
            'type' => $item->getType(),
            'location' => $item->getLocation(),
            'label' => $item->getLabel(),
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
