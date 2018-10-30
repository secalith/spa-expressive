<?php

declare(strict_types=1);

namespace Event\Service;

class EventService
{
    protected $nativeTableServices;

    public function __construct($nativeTableServices)
    {
        $this->nativeTableServices = $nativeTableServices;
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