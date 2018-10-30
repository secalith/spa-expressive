<?php

declare(strict_types=1);

namespace Common\Paginator;

use Zend\Paginator\Paginator;

interface PaginatorAwareInterface
{

    public function setPaginator(Paginator $paginator);

    public function getPaginator() : Paginator;

}