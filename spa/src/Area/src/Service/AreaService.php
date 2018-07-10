<?php

declare(strict_types=1);

namespace Area\Service;

use Interop\Container\ContainerInterface;

class AreaService
{
    protected $tableArea;

    public function __construct($tableArea)
    {
        $this->tableArea = $tableArea;
    }

    public function mergeAreasByTemplateUid($template_uid)
    {
        $templateAreas = $this->tableArea->fetchAllAreasBy($template_uid,'template_uid');
        return $templateAreas;
        // get global areas
//        $globalAreas = $this->tableArea->fetchAllBy('global','scope');

        $templateAreas = (!empty($templateAreas)&&!empty($globalAreas))
            ? array_merge($globalAreas->toArray(),$templateAreas->toArray())
            : (!empty($globalAreas)
                ? $globalAreas
                : (!empty($templateAreas))
                    ?$templateAreas:null
            )
        ;

        return $templateAreas;
    }
}