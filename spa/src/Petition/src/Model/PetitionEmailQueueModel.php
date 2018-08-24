<?php

declare(strict_types=1);

namespace Petition\Model;

class PetitionEmailQueueModel
{
    public $uid;
    public $application_uid;
    public $site_uid;

    public $petition_uid;
    public $petition_translation_uid;
    public $petition_language;
    public $recipients_group_uid;

    public $comm;
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
        $this->uid = ( array_key_exists('uid',$data)) ? $data['uid'] : null;
        $this->application_uid = ( array_key_exists('application_uid',$data)) ? $data['application_uid'] : null;
        $this->site_uid = ( array_key_exists('site_uid',$data)) ? $data['site_uid'] : null;

        $this->petition_uid = ( array_key_exists('petition_uid',$data)) ? $data['petition_uid'] : null;
        $this->petition_translation_uid = ( array_key_exists('petition_translation_uid',$data)) ? $data['petition_translation_uid'] : null;
        $this->petition_language = ( array_key_exists('petition_language',$data)) ? $data['petition_language'] : null;
        $this->recipients_group_uid = ( array_key_exists('recipients_group_uid',$data)) ? $data['recipients_group_uid'] : null;

        $this->comm = ( array_key_exists('comm',$data)) ? $data['comm'] : null;
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

        $data['uid'] = $this->uid;
        $data['application_uid'] = $this->application_uid;
        $data['site_uid'] = $this->site_uid;

        $data['petition_uid'] = $this->petition_uid;
        $data['petition_translation_uid'] = $this->petition_translation_uid;
        $data['petition_language'] = $this->petition_language;
        $data['recipients_group_uid'] = $this->recipients_group_uid;

        $data['comm'] = $this->comm;
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
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * @param mixed $uid
     * @return PetitionModel
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getApplicationUid()
    {
        return $this->application_uid;
    }

    /**
     * @param mixed $application_uid
     * @return PetitionModel
     */
    public function setApplicationUid($application_uid)
    {
        $this->application_uid = $application_uid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSiteUid()
    {
        return $this->site_uid;
    }

    /**
     * @param mixed $site_uid
     * @return PetitionModel
     */
    public function setSiteUid($site_uid)
    {
        $this->site_uid = $site_uid;
        return $this;
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
     * @return PetitionModel
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
     * @return PetitionEmailQueueModel
     */
    public function setPetitionTranslationUid($petition_translation_uid)
    {
        $this->petition_translation_uid = $petition_translation_uid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPetitionLanguage()
    {
        return $this->petition_language;
    }

    /**
     * @param mixed $petition_language
     * @return PetitionModel
     */
    public function setPetitionLanguage($petition_language)
    {
        $this->petition_language = $petition_language;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRecipientsGroupUid()
    {
        return $this->recipients_group_uid;
    }

    /**
     * @param mixed $recipients_group_uid
     * @return PetitionModel
     */
    public function setRecipientsGroupUid($recipients_group_uid)
    {
        $this->recipients_group_uid = $recipients_group_uid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getComm()
    {
        return $this->comm;
    }

    /**
     * @param mixed $comm
     * @return PetitionModel
     */
    public function setComm($comm)
    {
        $this->comm = $comm;
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
     * @return PetitionModel
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
     * @return PetitionModel
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
     * @return PetitionModel
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }
}
