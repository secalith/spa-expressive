<?php

declare(strict_types=1);

namespace Page\Service;

class PageService
{
    protected $tablePage;
    protected $instance;

    public function __construct($tablePage,$instance)
    {
        $this->tablePage = $tablePage;
        $this->instance = $instance;
    }

    public function getPageByRouteName($route_name)
    {
        /* @var \Page\Model\PageModel $page */
        $page = $this->tablePage->fetchBy(
            [
                'name'=>$route_name,
                'site_uid'=>$this->instance->getSiteUid()
            ]);

        return $page;
    }
}