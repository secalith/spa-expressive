<?php

declare(strict_types=1);

namespace Common\Model;

interface WriteTableInterface
{

    /**
     * @param array $data
     * @return array
     */
    public function saveItem($data);


    /**
     * @return array
     */
    public function updateItem($uid,$data);

}
