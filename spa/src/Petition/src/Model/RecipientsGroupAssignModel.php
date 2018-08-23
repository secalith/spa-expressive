<?php

declare(strict_types=1);

namespace Petition\Model;

class RecipientsGroupAssignModel
{
    public $recipient_uid;
    public $group_uid;

    public $status;

    public $created;
    public $updated;

    /**
     * PageModel constructor.
     * @param array $data
     */
    public function __construct($data = [])
    {
        $this->exchangeArray($data);
    }

    /**
     * @param array $data
     */
    public function exchangeArray($data = [])
    {
        $this->recipient_uid = ( array_key_exists('recipient_uid',$data)) ? $data['recipient_uid'] : null;
        $this->group_uid = ( array_key_exists('group_uid',$data)) ? $data['group_uid'] : null;

        $this->status = ( array_key_exists('status',$data)) ? $data['status'] : null;

        $this->created = ( array_key_exists('created',$data)) ? $data['created'] : null;
        $this->updated = ( array_key_exists('updated',$data)) ? $data['updated'] : null;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $data = [];

        $data['recipient_uid'] = $this->recipient_uid;
        $data['group_uid'] = $this->group_uid;

        $data['status'] = $this->status;

        $data['created'] = $this->created;
        $data['updated'] = $this->updated;

        return $data;
    }

    /**
     * @return array
     */
    public function getArrayCopy()
    {
        return $this->toArray();
    }

    /**
     * @return mixed
     */
    public function getRecipientUid()
    {
        return $this->recipient_uid;
    }

    /**
     * @param mixed $recipient_uid
     * @return RecipientsGroupAssignModel
     */
    public function setRecipientUid($recipient_uid)
    {
        $this->recipient_uid = $recipient_uid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGroupUid()
    {
        return $this->group_uid;
    }

    /**
     * @param mixed $group_uid
     * @return RecipientsGroupAssignModel
     */
    public function setGroupUid($group_uid)
    {
        $this->group_uid = $group_uid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     * @return RecipientsGroupAssignModel
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     * @return RecipientsGroupAssignModel
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param mixed $updated
     * @return RecipientsGroupAssignModel
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }

}
