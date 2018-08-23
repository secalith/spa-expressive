<?php

declare(strict_types=1);

namespace Petition\Model;

class PetitionRecipientsGroupModel
{
    public $petition_uid;
    public $petition_translation_uid;
    public $recipient_group_uid;

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
        $this->petition_uid = ( array_key_exists('petition_uid',$data)) ? $data['petition_uid'] : null;
        $this->petition_translation_uid = ( array_key_exists('petition_translation_uid',$data)) ? $data['petition_translation_uid'] : null;
        $this->recipient_group_uid = ( array_key_exists('recipient_group_uid',$data)) ? $data['recipient_group_uid'] : null;
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

        $data['petition_uid'] = $this->petition_uid;
        $data['petition_translation_uid'] = $this->petition_translation_uid;
        $data['recipient_group_uid'] = $this->recipient_group_uid;

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
    public function getPetitionUid()
    {
        return $this->petition_uid;
    }

    /**
     * @param mixed $petition_uid
     * @return PetitionRecipientsGroupModel
     */
    public function setPetitionUid($petition_uid)
    {
        $this->petition_uid = $petition_uid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPetitionTranslationUid()
    {
        return $this->petition_translation_uid;
    }

    /**
     * @param mixed $petition_translation_uid
     * @return PetitionRecipientsGroupModel
     */
    public function setPetitionTranslationUid($petition_translation_uid)
    {
        $this->petition_translation_uid = $petition_translation_uid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRecipientGroupUid()
    {
        return $this->recipient_group_uid;
    }

    /**
     * @param mixed $recipient_group_uid
     * @return PetitionRecipientsGroupModel
     */
    public function setRecipientGroupUid($recipient_group_uid)
    {
        $this->recipient_group_uid = $recipient_group_uid;
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
     * @return PetitionRecipientsGroupModel
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
     * @return PetitionRecipientsGroupModel
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
     * @return PetitionRecipientsGroupModel
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }

}
