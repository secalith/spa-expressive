<?php

declare(strict_types=1);

namespace Common\Model;

class CommonCollection
{
    private $items = array();

    public function addItem($obj, $key = null)
    {
        if ($key == null) {
            $this->items[] = $obj;
        }
        else {
            if (isset($this->items[$key])) {
                throw new \Exception("Key $key already in use.");
            }
            else {
                $this->items[$key] = $obj;
            }
        }
    }

    public function deleteItem($key)
    {
        if (isset($this->items[$key])) {
            unset($this->items[$key]);
        } else {
            throw new \Exception("Invalid key $key.");
        }
    }

    public function getItem($key)
    {
        if (isset($this->items[$key])) {
            return $this->items[$key];
        } else {
            throw new \Exception("Invalid key $key.");
        }
    }

    public function getItems()
    {
        return $this->items;
    }

    public function keys()
    {
        return array_keys($this->items);
    }

    public function count()
    {
        return count($this->items);
    }

    public function keyExists($key)
    {
        return isset($this->items[$key]);
    }

    public function toArray()
    {
        $r = [];
        foreach($this->items as $key=>$item){
            $r[$key] = $item->toArray();
        }

        return $r;
    }

    public function firstItem()
    {
        if( ! is_array($this->items)) {
            return null;
        }
        $itemsAll = array_values($this->items);
        return $itemsAll[0];
    }
}