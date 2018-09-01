<?php

declare(strict_types=1);

namespace Petition\Model;

class PetitionSignatureModel
{
    public $uid;
    public $application_uid;
    public $site_uid;
    public $petition_uid;

    public $name;
    public $email;

    public $newsletter;
    public $terms;
    public $privacy_policy;

    public $ip;

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
        $this->name = ( array_key_exists('name',$data)) ? $data['name'] : null;

        $this->email = ( array_key_exists('email',$data)) ? $data['email'] : null;

        $this->newsletter = ( array_key_exists('newsletter',$data)) ? $data['newsletter'] : null;
        $this->terms = ( array_key_exists('terms',$data)) ? $data['terms'] : null;
        $this->privacy_policy = ( array_key_exists('terms',$data)) ? $data['privacy_policy'] : null;

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
        $data['name'] = $this->name;

        $data['email'] = $this->email;

        $data['newsletter'] = $this->newsletter;
        $data['terms'] = $this->terms;
        $data['privacy_policy'] = $this->privacy_policy;

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
     * @return PetitionSignatureModel
     */
    public function setPetitionUid($petition_uid)
    {
        $this->petition_uid = $petition_uid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return PetitionSignatureModel
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return PetitionSignatureModel
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }



    /**
     * @return mixed
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param mixed $ip
     * @return PetitionSignatureModel
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNewsletter()
    {
        return $this->newsletter;
    }

    /**
     * @param mixed $newsletter
     * @return PetitionSignatureModel
     */
    public function setNewsletter($newsletter)
    {
        $this->newsletter = $newsletter;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTerms()
    {
        return $this->terms;
    }

    /**
     * @param mixed $terms
     * @return PetitionSignatureModel
     */
    public function setTerms($terms)
    {
        $this->terms = $terms;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrivacyPolicy()
    {
        return $this->privacy_policy;
    }

    /**
     * @param mixed $privacy_policy
     * @return PetitionSignatureModel
     */
    public function setPrivacyPolicy($privacy_policy)
    {
        $this->privacy_policy = $privacy_policy;
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
     * @return PetitionSignatureModel
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
     * @return PetitionSignatureModel
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }

}
