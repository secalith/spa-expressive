<?php

declare(strict_types=1);

namespace Petition\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Petition\Model\PetitionTranslationModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilter;

class PetitionTranslationFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $event_groups;

    public function __construct($name = null, $options = array(), $event_groups=[])
    {
        parent::__construct($name,$options);

        $this->setHydrator(new ClassMethods(true));
        $this->setObject(new PetitionTranslationModel());

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
                'class' => 'form-control d-inline-flex w-auto',
                'value' => microtime(),
            ],
        ));
        $this->add(array(
            'type' => 'hidden',
            'name' => 'petition_uid',
            'options' => array(
                'label' => _("UID")
            ),
            'attributes' => [
                'class' => 'form-control d-inline-flex w-auto',
                'value' => microtime(),
            ],
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\hidden',
            'name' => 'application_uid',
            'options' => array(
                'label' => _("Aplikacja"),
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
                'label' => _("Site"),
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
            'name' => 'title',
            'options' => array(
                'label' => _("Title")
            ),
            'attributes' => [
                'class' => 'form-control d-block',
                'placeholder' => _("eg. Petition to EU, refuse directive."),
            ],
        ));

        $this->add(array(
            'type' => 'textarea',
            'name' => 'description',
            'options' => array(
                'label' => _("Description")
            ),
            'attributes' => [
                'class' => 'form-control d-block',
                'placeholder' => _("eg. Petition to EU, refuse directive."),
            ],
        ));

        $this->add(array(
            'type' => 'textarea',
            'name' => 'text',
            'options' => array(
                'label' => _("Petition Text")
            ),
            'attributes' => [
                'class' => 'form-control d-block',
                'placeholder' => _("eg. Petition to EU, refuse directive."),
            ],
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'language',
            'options' => array(
                'label' => _("Language"),
                'value_options' => $this->get_eu_countries(),
            ),
            'attributes' => [
                'class' => 'form-control d-block',
            ],
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'status',
            'options' => array(
                'label' => _("Status"),
                'value_options' => [
                    '0' => _("Hidden"),
                    '1' => _("Visible"),

                ],
            ),
            'attributes' => [
                'class' => 'form-control d-block',
            ],
        ));

    }

    public function getInputFilterSpecification()
    {
        return array(
            'uid' => array(
                'required' => true,
            ),
            'application_uid' => array(
                'required' => true,
            ),
            'site_uid' => array(
                'required' => true,
            ),
            'title' => array(
                'required' => true,
            ),
            'description' => array(
                'required' => true,
            ),
            'text' => array(
                'required' => true,
            ),
            'language' => array(
                'required' => true,
            ),
            'status' => array(
                'required' => true,
            ),
        );
    }

    public function get_eu_countries() {
        $countries = [];
        $countries['en_en'] = 'Global';
        $countries['AT'] = 'Austria';
        $countries['BE'] = 'Belgium';
        $countries['BG'] = 'Bulgaria';
        $countries['CY'] = 'Cyprus';
        $countries['CZ'] = 'Czech Republic';
        $countries['DE'] = 'Germany';
        $countries['DK'] = 'Denmark';
        $countries['EE'] = 'Estonia';
        $countries['ES'] = 'Spain';
        $countries['FI'] = 'Finland';
        $countries['FR'] = 'France';
        $countries['GB'] = 'United Kingdom';
        $countries['GR'] = 'Greece';
        $countries['HU'] = 'Hungary';
        $countries['HR'] = 'Croatia';
        $countries['IE'] = 'Ireland, Republic of (EIRE)';
        $countries['IT'] = 'Italy';
        $countries['LT'] = 'Lithuania';
        $countries['LU'] = 'Luxembourg';
        $countries['LV'] = 'Latvia';
        $countries['MT'] = 'Malta';
        $countries['NL'] = 'Netherlands';
        $countries['PL'] = 'Poland';
        $countries['PT'] = 'Portugal';
        $countries['RO'] = 'Romania';
        $countries['SE'] = 'Sweden';
        $countries['SI'] = 'Slovenia';
        $countries['SK'] = 'Slovakia';

        return $countries;
    }

}