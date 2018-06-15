<?php

declare(strict_types=1);

namespace Common\Model;

interface CommonModelInterface
{

    /**
     * @param array $data
     * @return array
     */
    public function exchangeArray(array $data = []);


    /**
     * @return array
     */
    public function toArray();

    /**
     * @return array
     */
    public function getArrayCopy();

}
