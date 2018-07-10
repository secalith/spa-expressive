<?php

declare(strict_types=1);

namespace Common\Handler;

use Zend\Form\Form;

interface ApplicationFormAwareInterface
{
    public function setForm(Form $form=null,string $index=null) : ApplicationFormAwareInterface;
    public function getForm(string $index=null);
    public function getForms() : array;
}
