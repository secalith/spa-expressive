<?php

declare(strict_types=1);

namespace Auth\Model;

class CodeModel
{
    public $code;

    public function __construct($data = [])
    {
        $this->exchangeArray($data);
    }

    public function exchangeArray($data = [])
    {
        $this->code = ( array_key_exists('code',$data))
            ? $data['code']
            : null;
    }

    public function toArray()
    {
        $data = [];

        $data['code'] = $this->code;

        return $data;
    }

    public function getArrayCopy()
    {
        return $this->toArray();
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     * @return CodesModel
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

}