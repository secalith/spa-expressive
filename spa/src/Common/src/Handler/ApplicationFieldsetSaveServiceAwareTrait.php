<?php

declare(strict_types=1);

namespace Common\Handler;

use Common\Handler\ApplicationFormAwareInterface;
use Zend\Form\Form;

trait ApplicationFieldsetSaveServiceAwareTrait
{
    protected $handlerFieldsetServices = [];

    public function setFieldsetService($form=null,string $index=null) : ApplicationFieldsetSaveServiceAwareInterface
    {
        if( $index!==null) {
            $this->handlerFieldsetServices[$index] = $form;
        } else {
            $this->handlerFieldsetServices[$form->getName()] = $form;
        }

        return $this;
    }

    /**
     * @param string|null $index
     * @return array|string|null
     */
    public function getFieldsetService( string $index=null)
    {
        if($index !== null) {
            if(array_key_exists($index,$this->handlerFieldsetServices)) {
                return $this->handlerFieldsetServices[$index];
            }
        }

        return null;
    }

    public function getFieldsetServiceAll() : array
    {
        return $this->handlerFieldsetServices;
    }

    /**
     * @param $key
     * @return bool
     */
    public function hasFieldsetService(string $key) : bool
    {
        return (array_key_exists($key,$this->handlerFieldsetServices))?true:false;
    }
}
