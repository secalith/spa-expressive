<?php

namespace Common\Delegator;

use Zend\Form\Form as Form;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface ApplicationFormRouteAwareInterface
{
    public function addRouteForm(Form $form, $name = null);

    public function getRouteForm($name);

    public function setRouteForms($forms);

    public function getRouteForms();
}
