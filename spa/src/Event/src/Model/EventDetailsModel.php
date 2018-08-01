<?php

declare(strict_types=1);

namespace Event\Model;

class EventDetailsModel
{
    public $uid;
    public $application_uid;
    public $site_uid;
    public $event_uid;
    public $name;
    public $city;
    public $city_global;
    public $date_start;
    public $date_finish;
    public $timezone;

    public $event_link_external;
    public $event_map_external;

    public $language;
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
        $this->event_uid = ( array_key_exists('event_uid',$data)) ? $data['event_uid'] : null;
        $this->name = ( array_key_exists('name',$data)) ? $data['name'] : null;
        $this->city = ( array_key_exists('city',$data)) ? $data['city'] : null;
        $this->city_global = ( array_key_exists('city_global',$data)) ? $data['city_global'] : null;
        $this->date_start = ( array_key_exists('date_start',$data)) ? $data['date_start'] : null;
        $this->date_finish = ( array_key_exists('date_finish',$data)) ? $data['date_finish'] : null;
        $this->timezone = ( array_key_exists('timezone',$data)) ? $data['timezone'] : null;

        $this->event_link_external = ( array_key_exists('event_link_external',$data)) ? $data['event_link_external'] : null;
        $this->event_map_external = ( array_key_exists('event_map_external',$data)) ? $data['event_map_external'] : null;

        $this->language = ( array_key_exists('language',$data)) ? $data['language'] : null;
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
        $data['event_uid'] = $this->event_uid;
        $data['name'] = $this->name;
        $data['city'] = $this->city;
        $data['city_global'] = $this->city_global;

        $data['date_start'] = $this->date_start;
        $data['date_finish'] = $this->date_finish;

        $data['event_link_external'] = $this->event_link_external;
        $data['event_map_external'] = $this->event_map_external;

        $data['timezone'] = $this->timezone;

        $data['language'] = $this->language;
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
     * @return EventDetailsModel
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
     * @return EventDetailsModel
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
     * @return EventDetailsModel
     */
    public function setSiteUid($site_uid)
    {
        $this->site_uid = $site_uid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEventUid()
    {
        return $this->event_uid;
    }

    /**
     * @param mixed $event_uid
     * @return EventDetailsModel
     */
    public function setEventUid($event_uid)
    {
        $this->event_uid = $event_uid;
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
     * @return EventDetailsModel
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     * @return EventDetailsModel
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCityGlobal()
    {
        return $this->city_global;
    }

    /**
     * @param mixed $city_global
     * @return EventDetailsModel
     */
    public function setCityGlobal($city_global)
    {
        $this->city_global = $city_global;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateStart()
    {
        return $this->date_start;
    }

    /**
     * @param mixed $date_start
     * @return EventDetailsModel
     */
    public function setDateStart($date_start)
    {
        $this->date_start = $date_start;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateFinish()
    {
        return $this->date_finish;
    }

    /**
     * @param mixed $date_finish
     * @return EventDetailsModel
     */
    public function setDateFinish($date_finish)
    {
        $this->date_finish = $date_finish;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * @param mixed $timezone
     * @return EventDetailsModel
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param mixed $language
     * @return EventDetailsModel
     */
    public function setLanguage($language)
    {
        $this->language = $language;
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
     * @return EventDetailsModel
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
     * @return EventDetailsModel
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
     * @return EventDetailsModel
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEventLinkExternal()
    {
        return $this->event_link_external;
    }

    /**
     * @param mixed $event_link_external
     * @return EventDetailsModel
     */
    public function setEventLinkExternal($event_link_external)
    {
        $this->event_link_external = $event_link_external;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEventMapExternal()
    {
        return $this->event_map_external;
    }

    /**
     * @param mixed $event_map_external
     * @return EventDetailsModel
     */
    public function setEventMapExternal($event_map_external)
    {
        $this->event_map_external = $event_map_external;
        return $this;
    }

}
