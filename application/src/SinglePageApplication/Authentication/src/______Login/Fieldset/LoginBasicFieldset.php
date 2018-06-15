<?php 
namespace Authentication\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ArraySerializable as Hydrator;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use Authentication\Form\Entity\LoginBasicEntity as BaseEntity;

class LoginBasicFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name='login',$options=[])
    {
        parent::__construct($name,$options);

        $this
            ->setHydrator(new ClassMethodsHydrator(false))
            ->setObject(new BaseEntity())
        ;

        $this->add(array(
            'name' => 'username',
            'options' => array(
                'label' => 'Username',
                'label_attributes' => array(
                    'for'  => 'authentication-username',
                ),
                'priority' => 200, // Increase value to move to top of form
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id'  => 'authentication-username',
            ),
        ));

        $this->add(array(
            'name' => 'password',
            'options' => array(
                'label' => 'Password',
                'label_attributes' => array(
                    'for'  => 'authentication-password',
                ),
                'priority' => 200, // Increase value to move to top of form
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id'  => 'authentication-password',
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
            'username' => [
                'required' => true,
                'filters' => [['name' => 'StringTrim',['name' => 'StripTags']],],
                'validators' => [[
                    'name'=>'StringLength',
                    'options'=>[
                        'encoding' => 'UTF-8',
                        'min'      => 3,
                        'max'      => 255,
                    ]]
                ],
            ],
            'password' => [
                'required' => true,
                'filters' => [['name' => 'StringTrim',['name' => 'StripTags']],],
                'validators' => [[
                    'name'=>'StringLength',
                    'options'=>[
                        'encoding' => 'UTF-8',
                        'min'      => 3,
                        'max'      => 255,
                    ]]
                ],
            ],
        ];
    }
}