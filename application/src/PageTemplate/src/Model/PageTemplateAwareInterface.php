<?php

namespace PageTemplate;

interface PageTemplateAwareInterface
{

    public function setTemplate($template);
    public function getTemplate();
}
