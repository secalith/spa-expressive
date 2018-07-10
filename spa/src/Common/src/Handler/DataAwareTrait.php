<?php

declare(strict_types=1);

namespace Common\Handler;

trait DataAwareTrait
{
    protected $data = [];

    /**
     * @param array $data
     * @param string|null $index
     * @return DataAwareInterface
     */
    public function setData($data = [], string $index=null) : DataAwareInterface
    {
        if($index!==null) {
            $this->addData($data,$index);
        } else {
            $this->data = $data;
        }

        return $this;
    }

    /**
     * @param string|null $index
     * @return array|string|null
     */
    public function getData( string $index=null)
    {
        if($index !== null) {
            if(array_key_exists($index,$this->data)) {
                return $this->data[$index];
            }
        }

        return $this->data;
    }

    /**
     * @param $data
     * @param string $index
     * @return DataAwareInterface
     */
    public function addData($data,string $index) : DataAwareInterface
    {
        $this->data[$index] = $data;

        return $this;
    }

    /**
     * @param $key
     * @return bool
     */
    public function keyExists($key)
    {
        return (array_key_exists($key,$this->data))?true:false;
    }
}
