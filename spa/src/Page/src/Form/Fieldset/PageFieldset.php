<?php

declare(strict_types=1);

namespace Page\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Page\Model\PageModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilter;

class PageFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name,$options);

        $this->setHydrator(new ClassMethods(true));
        $this->setObject(new PageModel());

        $this->addElements();
    }

    protected function addElements()
    {

        $time = time();

        $this->add(array(
            'type' => 'text',
            'name' => 'uid',
            'options' => array(
                'label' => _("UID")
            ),
            'attributes' => [
                'class' => 'form-control d-inline-flex w-auto',
                'value' => $time,
            ],
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'page_type',
            'options' => array(
                'label' => _("Page Type"),
                'value_options' => [
                    'event' => _("Event"),
                    'petition' => _("Petition"),
                    'links' => _("Links"),
                ],
            ),
            'attributes' => [
                'class' => 'form-control toggle-aware-trigger d-inline-flex w-auto',
                'data-toggle' => '{"event":{"show":["page_type_event"]},"petition":{"show":["page_type_petition"]},"links":{"show":["page_type_links"]}}',
                'onChange' => 'javascript:spaForm.toggleFieldset($(this));return false;',
            ],
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'language',
            'options' => array(
                'label' => _("Country"),
                'value_options' => $this->get_eu_countries(),
            ),
            'attributes' => [
                'class' => 'form-control d-inline-flex w-auto bt-multiselect',
            ],
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'name',
            'options' => array(
                'label' => _("Nazwa")
            ),
            'attributes' => [
                'class' => 'form-control d-inline-flex w-auto',
                'value' => 'petycja-' . time(),
            ],
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'application_uid',
            'options' => array(
                'label' => _("Aplikacja"),
                'value_options' => [
                    'app-001' => _("app-001"),

                ],
            ),
            'attributes' => [
                'class' => 'form-control d-inline-flex w-auto',
            ],
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'site_uid',
            'options' => array(
                'label' => _("Witryna"),
                'value_options' => [
                    'site-003' => _("petitions.local.vm"),
                    'site-001' => _("manager.local.vm"),
                    'site-002' => _("art13.local.vm"),
                    'site-004' => _("petycja.art13.eu"),

                ],
            ),
            'attributes' => [
                'class' => 'form-control d-inline-flex w-auto bt-multiselect',
            ],
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'route_url',
            'options' => array(
                'label' => _("Url")
            ),
            'attributes' => [
                'class' => 'form-control d-inline-flex w-auto',
                'value' => '/petycja/' . time() .'[/]',
            ],
        ));

        $this->add(array(
            'type' => 'hidden',
            'name' => 'template_uid',
        ));
        $this->add(array(
            'type' => 'hidden',
            'name' => 'route_uid',
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'page_cache',
            'options' => array(
                'label' => _("Cache"),
                'value_options' => [
                    '0' => _("Wylaczony"),
                    '1' => _("Aktywny"),

                ],
            ),
            'attributes' => [
                'class' => 'form-control d-inline-flex w-auto',
            ],
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'status',
            'options' => array(
                'label' => _("Page Status"),
                'value_options' => [
                    '0' => _("Wylaczona"),
                    '1' => _("Aktywna"),

                ],
            ),
            'attributes' => [
                'class' => 'form-control d-inline-flex w-auto',
            ],
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'page_layout',
            'options' => array(
                'label' => _("Uklad Strony"),
                'value_options' => [
                    'page-layout::petitions' => _("Petycja"),
                    'layout::default' => _("Domyslna"),

                ],
            ),
            'attributes' => [
                'class' => 'form-control d-inline-flex w-auto',
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
            'route_url' => array(
                'required' => true,
            ),
            'template_uid' => array(
                'required' => true,
            ),
            'page_layout' => array(
                'required' => true,
            ),
            'page_cache' => array(
                'required' => true,
            ),
            'route_uid' => array(
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