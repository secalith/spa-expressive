<?php 
namespace Authentication\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ArraySerializable as Hydrator;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use Authentication\Form\Entity\LoginAdditionalEntity as BaseEntity;

class LoginAdditionalFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name='authentication',$options=[])
    {
        parent::__construct($name,$options);

        $this
            ->setHydrator(new ClassMethodsHydrator(false))
            ->setObject(new BaseEntity())
        ;

        $this->add(array(
            'name' => 'keep_logged_in',
            'type' => 'checkbox',
            'options' => array(
                'label' => 'Keep me logged in',
                'label_attributes' => array(
                    'for'  => 'authentication-keep-logged-in',
                ),
                'use_hidden_element' => true,
                'checked_value' => 1,
                'unchecked_value' => 0,
            ),
            'attributes' => array(
                'id'  => 'authentication-keep-logged-in',
            ),
        ));

        return $this;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     */
    public function getInputFilterSpecification()
    {
        return [
            'keep_logged_in' => [
                'required' => false,
                'filters' => [['name' => 'StringTrim',['name' => 'StripTags']],],
                'validators' => [[
                    'name'=>'StringLength',
                    'options'=>[
                        'encoding' => 'UTF-8',
                        'min'      => 1,
                        'max'      => 1,
                    ]]
                ],
            ],
        ];
    }
}