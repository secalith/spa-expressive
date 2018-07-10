<?php

namespace Form;

use Zend\Form\Form as Form;
use Zend\Form\Factory as FormFactory;

interface FormFactoryAwareInterface
{
    /**
     * @param FormFactory $form
     * @param null $name
     * @return $this
     */
    public function setFormFactory(FormFactory $form_factory);

    /**
     * @param $name
     * @return FormFactory|null
     */
    public function getFormFactory();
}
