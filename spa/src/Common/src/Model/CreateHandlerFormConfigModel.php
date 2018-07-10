<?php

declare(strict_types=1);

namespace Common\Model;

class CreateHandlerFormConfigModel
{
    public $name;
    public $action;
    public $object;
    public $save;

    /**
     * CartItemModel constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        if (! empty($data)) {
            $this->exchangeArray($data);
        }
    }

    /**
     * Populates the Object with data from the provided Array
     *
     * @param array $data
     * @return OrderItemModel
     */
    public function exchangeArray(array $data = [])
    {
        $this->name = (!empty($data['name'])) ? $data['name'] : null;
        $this->action = (!empty($data['action'])) ? $data['action'] : null;
        $this->object = (!empty($data['object'])) ? $data['object'] : null;
        $this->save = (!empty($data['save'])) ? $data['save'] : null;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if ($this->name !== null) {
            $data['name'] = $this->name;
        }
        if ($this->action !== null) {
            $data['action'] = $this->action;
        }
        if ($this->object !== null) {
            $data['object'] = $this->object;
        }
        if ($this->save !== null) {
            $data['save'] = $this->save;
        }

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return CreateHandlerFormConfigModel
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $action
     * @return CreateHandlerFormConfigModel
     */
    public function setAction($action)
    {
        $this->action = $action;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * @param mixed $object
     * @return CreateHandlerFormConfigModel
     */
    public function setObject($object)
    {
        $this->object = $object;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSave()
    {
        return $this->save;
    }

    /**
     * @param mixed $save
     * @return CreateHandlerFormConfigModel
     */
    public function setSave($save)
    {
        $this->save = $save;
        return $this;
    }

}
