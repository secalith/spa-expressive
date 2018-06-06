<?php

declare(strict_types=1);

namespace Common\Paginator;

use Zend\Paginator\Paginator;

trait PaginatorAwareTrait
{
    protected $paginator;

    public function setPaginator(Paginator $paginator)
    {
        $this->paginator = $paginator;
    }

    public function getPaginator() : Paginator
    {
        return $this->paginator;
    }
}