<?php

declare(strict_types=1);

namespace PageTemplate\Service;

class TemplateService
{
    protected $tableTemplate;

    public function __construct($tableTemplate)
    {
        $this->tableTemplate = $tableTemplate;
    }

    public function getByUid($uid)
    {
        $templateData = $this->tableTemplate
            ->fetchBy($uid,'uid');

        return $templateData;
    }
}