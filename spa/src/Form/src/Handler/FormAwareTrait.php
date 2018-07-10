<?php

namespace Form;

use Zend\Form\Form as Form;

trait FormAwareTrait
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
    public function addForm(Form $form, $name = null)
    {
        $this->forms[$name] = $form;
        return $this;
    }

    /**
     * @param string $name
     * @return Form|null
     */
    public function getForm($name)
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
    public function setForms($forms)
    {
        $this->forms = $forms;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getForms()
    {
        return $this->forms;
    }
}
