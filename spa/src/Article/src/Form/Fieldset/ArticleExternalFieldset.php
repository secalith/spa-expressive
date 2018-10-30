<?php

declare(strict_types=1);

namespace Article\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Article\Model\ArticleExternalModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilter;

class ArticleExternalFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $event_groups;

    public function __construct($name = null, $options = array(), $event_groups=[])
    {
        parent::__construct($name,$options);

        $this->setHydrator(new ClassMethods(true));
        $this->setObject(new ArticleExternalModel());

        $this->event_groups = $event_groups;

        $this->addElements();
    }

    protected function addElements()
    {

        $this->add(array(
            'type' => 'hidden',
            'name' => 'uid',
            'options' => array(
                'label' => _("UID")
            ),
            'attributes' => [
                'class' => 'form-control d-block',
                'value' => microtime(),
            ],
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\hidden',
            'name' => 'application_uid',
            'options' => array(
                'label' => _("App UID"),
                'value_options' => [
                    'app-001' => _("app-001"),
                ],
            ),
            'attributes' => [
                'class' => 'form-control d-block',
                'value' => 'app-001',
            ],
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\hidden',
            'name' => 'site_uid',
            'options' => array(
                'label' => _("Site UID"),
                'value_options' => [
                    'site-001' => _("site-001"),
                ],
            ),
            'attributes' => [
                'class' => 'form-control d-block',
                'value' => 'site-001',
            ],
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'name',
            'options' => array(
                'label' => _("Title")
            ),
            'attributes' => [
                'class' => 'form-control d-block',
                'placeholder' => _("eg. BBC on the art13 issue March 2018"),
            ],
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'link',
            'options' => array(
                'label' => _("Url")
            ),
            'attributes' => [
                'class' => 'form-control d-block',
                'placeholder' => _("eg. https://bbc.co.uk"),
            ],
        ));

        $this->add(array(
            'type' => 'file',
            'name' => 'image',
            'options' => array(
                'label' => _("Image")
            ),
            'attributes' => [
                'class' => 'd-block',
                'placeholder' => _("eg. https://bbc.co.uk"),
            ],
        ));


    }

    public function getInputFilterSpecification()
    {
        return array(
            'uid' => array(
                'required' => true,
            ),
            'name' => array(
                'required' => true,
            ),
            'link' => array(
                'required' => true,
            ),
            'application_uid' => array(
                'required' => true,
            ),
            'site_uid' => array(
                'required' => true,
            ),
        );
    }

}