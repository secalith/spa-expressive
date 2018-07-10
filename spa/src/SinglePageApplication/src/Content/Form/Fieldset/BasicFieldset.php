<?php 
namespace SinglePageApplication\Content\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use SinglePageApplication\Content\Model\ContentModel as Model;
 
class BasicFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name='singlepageapplication_content_update',$options=[])
    {
        parent::__construct($name,$options);

        $this->setHydrator(new ClassMethodsHydrator(false))
            ->setObject(new Model())
        ;

        $this->add(array(
            'name' => 'uid',
            'options' => array(
                'label' => 'Unique ID',
                'label_attributes' => array(
                    'for'  => 'update-basic-uid',
                ),
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id'  => 'update-basic-uid',
            ),
        ));

        $this->add(array(
            'name' => 'content',
            'type' => 'textarea',
            'options' => array(
                'label' => 'Content',
                'label_attributes' => array(
                    'for'  => 'update-basic-content',
                ),
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id'  => 'update-basic-content',
                'rows' => '10',
            ),
        ));
/*
        $this->add(array(
            'name' => 'block',
            'type' => 'text',
            'options' => array(
                'label' => 'Block',
                'label_attributes' => array(
                    'for'  => 'update-basic-block',
                ),
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id'  => 'update-basic-block',
            ),
        ));

        $this->add(array(
            'name' => 'template',
            'type' => 'text',
            'options' => array(
                'label' => 'Template',
                'label_attributes' => array(
                    'for'  => 'update-basic-template',
                ),
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id'  => 'update-basic-template',
            ),
        ));

        $this->add(array(
            'name' => 'type',
            'type' => 'text',
            'options' => array(
                'label' => 'Type',
                'label_attributes' => array(
                    'for'  => 'update-basic-type',
                ),
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id'  => 'update-basic-type',
            ),
        ));

        $this->add(array(
            'name' => 'attributes',
            'type' => 'textarea',
            'options' => array(
                'label' => 'Attributes',
                'label_attributes' => array(
                    'for'  => 'update-basic-attributes',
                ),
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id'  => 'update-basic-attributes',
                'rows' => '3',
            ),
        ));

        $this->add(array(
            'name' => 'parameters',
            'type' => 'textarea',
            'options' => array(
                'label' => 'Parameters',
                'label_attributes' => array(
                    'for'  => 'update-basic-parameters',
                ),
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id'  => 'update-basic-parameters',
                'rows' => '3',
            ),
        ));

        $this->add(array(
            'name' => 'options',
            'type' => 'textarea',
            'options' => array(
                'label' => 'Options',
                'label_attributes' => array(
                    'for'  => 'update-basic-options',
                ),
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id'  => 'update-basic-options',
                'rows' => '3',
            ),
        ));
*/
        return $this;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     */
    public function getInputFilterSpecification()
    {
        return [
            'uid' => [
                'required' => false,
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
            'content' => [
                'required' => true,
                'filters' => [
                    ['name' => 'StringTrim',['name' => 'StripTags']],],
                'validators' => [[
                    'name'=>'StringLength',
                    'options'=>[
                        'encoding' => 'UTF-8',
                        'min'      => 3,
                    ],
                ],],
            ],
        ];
    }
}