<?php 
namespace SinglePageApplication\Content\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use SinglePageApplication\Content\Model\ContentModel as Model;
 
class UpdateFoundationFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name='singlepageapplication_content_update',$options=[])
    {
        parent::__construct($name,$options);

        $this->setHydrator(new ClassMethodsHydrator(false))
            //->setObject(new Model())
        ;

        $this->add(array(
            'type' => 'SinglePageApplication\Content\Form\Fieldset\BasicFieldset',
            'name' => 'basic',
            'options' => array(
                'label' => 'Basic Data',
            )
        ));

        $this->add(
            array(
                'name' => 'submit',
                'type' => 'submit',
                'attributes' => array(
                    'value' => 'Update',
                    'type' => 'submit',
                    'class' => 'btn btn-success',
                ),
            )
        );

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