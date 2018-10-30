<?php

declare(strict_types=1);

namespace Common\Handler;

use Common\Handler\ApplicationFormAwareInterface;
use Zend\Form\Form;

trait ApplicationFormAwareTrait
{
    protected $handlerForms = [];

    public function setForm(Form $form=null,string $index=null) : ApplicationFormAwareInterface
    {
        if( $index!==null) {
            $this->handlerForms[$index] = $form;
        } else {
            $this->handlerForms[$form->getName()] = $form;
        }

        return $this;
    }

    /**
     * @param string|null $index
     * @return array|string|null
     */
    public function getForm( string $index=null)
    {
        if($index !== null) {
            if(array_key_exists($index,$this->handlerForms)) {
                return $this->handlerForms[$index];
            }
        }

        return null;
    }

    public function getForms() : array
    {
        return $this->handlerForms;
    }
}
