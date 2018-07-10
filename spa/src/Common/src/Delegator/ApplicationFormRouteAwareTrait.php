<?php

namespace Common\Delegator;

use Zend\Form\Form as Form;

trait ApplicationFormRouteAwareTrait
{
    /**
     * @var array|null
     */
    protected $forms;

    /**
     * @param Form $form
     * @param string|null $name
     * @return $this
     */
    public function addRouteForm(Form $form, $name = null)
    {
        $this->forms[$name] = $form;
        return $this;
    }

    /**
     * @param string $name
     * @return Form|null
     */
    public function getRouteForm($name)
    {
        if (array_key_exists($name, $this->forms)) {
            return $this->forms[$name];
        }
        return null;
    }

    /**
     * @param $forms
     * @return $this
     */
    public function setRouteForms($forms)
    {
        $this->forms = $forms;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getRouteForms()
    {
        return $this->forms;
    }
}
