<?php

declare(strict_types=1);

namespace Content\Model;

use Common\Model\GerenateUUIDTrait;
use Content\Model\ContentModel;
use Zend\Db\TableGateway\TableGateway;

class ContentTable
{
    use GerenateUUIDTrait;

    /**
     * @var TableGateway
     */
    protected $tableGateway;

    /**
     * ContentTable constructor.
     * @param TableGateway $tableGateway
     */
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    /**
     * @param string $uid
     * @return \Content\Model\ContentModel
     * @throws \Exception
     */
    public function getItem(string $uid) : ContentModel
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

    public function fetchAllBy($value, $name = "uid")
    {
        if(is_array($value)) {
            $rowset = $this->tableGateway->select($value);
        } else {
            $rowset = $this->tableGateway->select([$name => $value]);
        }

        return $rowset->buffer();
    }
}
