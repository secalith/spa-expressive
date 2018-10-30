<?php

declare(strict_types=1);

namespace Event\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Event\Model\EventDetailsModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilter;


class EventDetailsFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $event_groups;

    public function __construct($name = null, $options = array(), $event_groups=[])
    {
        parent::__construct($name,$options);

        $this->setHydrator(new ClassMethods(true));
        $this->setObject(new EventDetailsModel());

        $this->event_groups = $event_groups;

        $this->addElements();
    }

    protected function addElements()
    {

        $this->add(array(
            'type' => 'hidden',
            'name' => 'uid',
        ));
        $this->add(array(
            'type' => 'hidden',
            'name' => 'status',
            'attributes' => [
                'value' => '1',
            ],
        ));

        $this->add(array(
            'type' => 'hidden',
            'name' => 'application_uid',
        ));

        $this->add(array(
            'type' => 'hidden',
            'name' => 'site_uid',
        ));

        $this->add(array(
            'type' => 'hidden',
            'name' => 'event_uid',
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'name',
            'options' => array(
                'label' => _("Name")
            ),
            'attributes' => [
                'class' => 'form-control d-block',
                'placeholder' => 'i.e. Protest #stopACTA2 w Warszawie (required)',
            ],
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'name_global',
            'options' => array(
                'label' => _("Global Name")
            ),
            'attributes' => [
                'class' => 'form-control d-block',
                'placeholder' => 'i.e. Protest #stopACTA2 in Warsaw (optional)',
            ],
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'language',
            'options' => array(
                'label' => _("1st Language"),
                'value_options' => $this->get_eu_countries(),
            ),
            'attributes' => [
                'class' => 'form-control d-block',
            ],
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'city',
            'options' => array(
                'label' => _("City")
            ),
            'attributes' => [
                'class' => 'form-control d-block',
                'placeholder' => 'i.e. Warszawa',
            ],
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'city_global',
            'options' => array(
                'label' => _("City (Global)")
            ),
            'attributes' => [
                'class' => 'form-control d-block',
                'placeholder' => 'i.e. Warsaw',
            ],
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'date_start',
            'options' => array(
                'label' => _("Date Start")
            ),
            'attributes' => [
                'class' => 'form-control d-block',
                'value' => '2018-07-29 19:00:00',
            ],
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'date_finish',
            'options' => array(
                'label' => _("Date Finish")
            ),
            'attributes' => [
                'class' => 'form-control d-block hidden',
                'value' => '2018-07-29 20:00:00',
            ],
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'timezone',
            'options' => array(
                'label' => _("Timezone"),
                'value_options' => [
                    'utc_0' => 'UTC',
                    'utc_1' => 'UTC+1',
                    'utc_2' => 'UTC+2',
                    'utc_3' => 'UTC+3',
                    'utc_4' => 'UTC+4',
                ],
            ),
            'attributes' => [
                'class' => 'form-control d-block',
            ],
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'date_finish_display',
            'options' => array(
                'label' => _("Only start date"),
                'use_hidden_element' => true,
                'checked_value' => 'yes',
                'unchecked_value' => 'no'
            ),
            'attributes' => [
                'id'=>'login-remember_me',
                'data-toggle' => '{"no":{"show":["date_finish"]},"yes":{"hide":["date_finish"]}}',
                'data-target' => '[name^=date_finish]',
                'onChange' => 'javascript:spaForm.toggleElement($(this));console.log(99);return false;',
            ],
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'event_link_external',
            'options' => array(
                'label' => _("External Link")
            ),
            'attributes' => [
                'class' => 'form-control d-block',
                'placeholder' => 'https://www.facebook.com/events/2035752230086477/',
            ],
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'event_map_external',
            'options' => array(
                'label' => _("Map Link")
            ),
            'attributes' => [
                'class' => 'form-control d-block',
                'placeholder' => 'https://www.google.co.uk/maps/@52.232277,21.0062105,17z/',
            ],
        ));

    }

    public function getInputFilterSpecification()
    {
        return array(
            'uid' => array(
                'required' => true,
                'continue_if_empty' => true,
            ),
            'application_uid' => array(
                'required' => false,
            ),
            'name' => array(
                'required' => true,
            ),
            'site_uid' => array(
                'required' => false,
            ),
            'event_uid' => array(
                'required' => true,
            ),
            'city' => array(
                'required' => true,
            ),
            'city_global' => array(
                'required' => true,
            ),
            'date_start' => array(
                'required' => true,
            ),
            'date_finish' => array(
                'required' => false,
            ),
            'timezone' => array(
                'required' => true,
            ),
            'language' => array(
                'required' => true,
            ),
            'event_link_external' => array(
                'required' => false,
            ),
            'event_map_external' => array(
                'required' => false,
            ),
            'status' => array(
                'required' => false,
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