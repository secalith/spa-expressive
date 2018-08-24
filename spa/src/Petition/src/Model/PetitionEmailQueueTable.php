<?php

declare(strict_types=1);

namespace Petition\Model;

use Petition\Model\PetitionEmailQueueModel;
use Zend\Db\TableGateway\TableGateway;
use Common\Model\GenerateUUIDTrait;

class PetitionEmailQueueTable
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
     * @param string $uid
     * @return \Page\Model\PageModel
     */
    public function getItem(string $uid) : PetitionEmailQueueModel
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

    public function getItemByUid($uid)
    {
        $rowset = $this->tableGateway->select(array('uid' => $uid));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $uid");
        }
        return $row;
    }

    public function updateStatus($status,$selector)
    {
        $rowsAffected = $this->tableGateway->update(['status'=>1], $selector);

        return [
            'affected' => $rowsAffected,
            'data' => ['status'=>1],
        ];
    }

    public function saveItem(PetitionEmailQueueModel $item)
    {
        if( null === $item->getUid() || empty($item->getUid())) {
            $item->setUid($this->generateUUID());
        }

        $dateTime = new \DateTime('now');

        $data = array(
            'uid' => $item->getUid(),
            'application_uid' => $item->getApplicationUid(),
            'petition_uid' => $item->getPetitionUid(),
            'petition_translation_uid' => $item->getPetitionTranslationUid(),
            'petition_language' => $item->getPetitionLanguage(),
            'recipients_group_uid' => $item->getRecipientsGroupUid(),
            'site_uid' => $item->getSiteUid(),
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
