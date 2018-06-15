<?php

declare(strict_types=1);

namespace Page\Service;

class PageService
{
    protected $tablePage;

    public function __construct($tablePage)
    {
        $this->tablePage = $tablePage;
    }

    public function getPageByRouteName($route_name)
    {
        /* @var \Page\Model\PageModel $page */
        $page = $this->tablePage->fetchBy($route_name,'name');

        return $page;
    }
}