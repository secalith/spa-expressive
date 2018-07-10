<?php

declare(strict_types=1);

namespace Common\Model;

interface ReadTableInterface
{
    public function fetchItem($data);
    public function fetchItems($data);
}
