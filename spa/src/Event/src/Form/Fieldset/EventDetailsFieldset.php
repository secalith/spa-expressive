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
                'class' => 'form-control d-inline-flex w-auto',
                'value' => 'event-' . time(),
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
                'class' => 'form-control d-inline-flex w-auto',
            ],
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'city',
            'options' => array(
                'label' => _("City")
            ),
            'attributes' => [
                'class' => 'form-control d-inline-flex w-auto',
                'value' => 'event-' . time(),
            ],
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'city_global',
            'options' => array(
                'label' => _("City (English)")
            ),
            'attributes' => [
                'class' => 'form-control d-inline-flex w-auto',
                'value' => 'event-' . time(),
            ],
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'date_start',
            'options' => array(
                'label' => _("Date Start")
            ),
            'attributes' => [
                'class' => 'form-control d-inline-flex w-auto',
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
                'class' => 'form-control d-inline-flex w-auto',
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
                'class' => 'form-control d-inline-flex w-auto',
            ],
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'event_link_external',
            'options' => array(
                'label' => _("External Link")
            ),
            'attributes' => [
                'class' => 'form-control d-inline-flex w-auto',
                'value' => 'https://www.facebook.com/events/2035752230086477/',
            ],
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'event_map_external',
            'options' => array(
                'label' => _("Map Link")
            ),
            'attributes' => [
                'class' => 'form-control d-inline-flex w-auto',
                'value' => 'https://www.google.co.uk/maps/place/plac+Defilad,+Warszawa,+Poland/@52.232277,21.0062105,17z/',
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
                'required' => true,
            ),
            'name' => array(
                'required' => true,
            ),
            'site_uid' => array(
                'required' => true,
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
                'required' => true,
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