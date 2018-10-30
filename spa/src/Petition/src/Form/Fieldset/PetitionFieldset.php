<?php

declare(strict_types=1);

namespace Petition\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Petition\Model\PetitionModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilter;

class PetitionFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $event_groups;

    public function __construct($name = null, $options = array(), $event_groups=[])
    {
        parent::__construct($name,$options);

        $this->setHydrator(new ClassMethods(true));
        $this->setObject(new PetitionModel());

        $this->event_groups = $event_groups;

        $this->addElements();
    }

    protected function addElements()
    {

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
            'type' => 'text',
            'name' => 'name',
            'options' => array(
                'label' => _("Internal name")
            ),
            'attributes' => [
                'class' => 'form-control d-block',
                'placeholder' => _("eg. Event in Warsaw on 26th :: 2nd wave (optional)"),
            ],
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'name_global',
            'options' => array(
                'label' => _("Global name")
            ),
            'attributes' => [
                'class' => 'form-control d-block',
                'placeholder' => _("eg. Event in Warsaw on 26/08 (optional)"),
            ],
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'country',
            'options' => array(
                'label' => _("Country"),
                'value_options' => $this->get_eu_countries(),
            ),
            'attributes' => [
                'class' => 'form-control d-block',
            ],
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'group',
            'options' => array(
                'label' => _("Group"),
                'value_options' => [
                    'petition-group-001' => 'Group #1'
                ],
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
            'name' => array(
                'required' => true,
            ),
            'country' => array(
                'required' => true,
            ),
            'application_uid' => array(
                'required' => true,
            ),
            'site_uid' => array(
                'required' => true,
            ),
            'group' => array(
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