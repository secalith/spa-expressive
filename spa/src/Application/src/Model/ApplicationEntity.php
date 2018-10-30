<?php

declare(strict_types=1);

namespace Application\Model;

class ApplicationEntity
{
    public $uid;
    public $type;

    public $comment;
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
        $this->type = ( array_key_exists('type',$data)) ? $data['type'] : null;

        $this->comment = ( array_key_exists('comment',$data)) ? $data['comment'] : null;
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
        $data['type'] = $this->type;

        $data['comment'] = $this->comment;
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

}
