<?php

namespace Form;

use Zend\Form\Form as Form;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface FormAwareInterface
{
    /**
     * @param Form $form
     * @param string|null $name
     * @param bool $strict
     * @return self
     */
    public function addForm(Form $form, $name = null);

    /**
     * @param string $name
     * @return Form|null
     */
    public function getForm($name);

    /**
     * @param $forms
     * @return self
     */
    public function setForms($forms);

    /**
     * @return array|null
     */
    public function getForms();
}
