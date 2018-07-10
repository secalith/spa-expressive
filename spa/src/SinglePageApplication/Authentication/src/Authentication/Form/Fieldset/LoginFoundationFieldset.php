<?php 
namespace Authentication\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ArraySerializable as Hydrator;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use Content\EmailTemplate\Entity\ContentEmailTemplateBasicEntity as BaseEntity;

class LoginFoundationFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name='authentication',$options=[])
    {
        parent::__construct($name,$options);

        $this->add(array(
            'type' => 'Authentication\Form\Fieldset\LoginBasicFieldset',
            'name' => 'login',
        ));

        $this->add(array(
            'type' => 'Authentication\Form\Fieldset\LoginAdditionalFieldset',
            'name' => 'additional',
        ));

        return $this;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     */
    public function getInputFilterSpecification()
    {
        return [];
    }
}