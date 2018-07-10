<?php

namespace Form;

use \Zend\Form\Factory as FormFactory;

trait FormFactoryAwareTrait
{
    protected $formFactory;

    /**
     * @param FormFactory $form
     * @param null $name
     * @return $this
     */
    public function setFormFactory(FormFactory $form_factory)
    {
        $this->formFactory = $form_factory;
        return $this;
    }

    /**
     * @param $name
     * @return FormFactory|null
     */
    public function getFormFactory()
    {
        return $this->formFactory;
    }
}
