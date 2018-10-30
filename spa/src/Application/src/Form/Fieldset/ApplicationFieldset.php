<?php

declare(strict_types=1);

namespace Application\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Application\Model\ApplicationModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilter;

class ApplicationFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $event_groups;

    public function __construct($name = null, $options = array(), $event_groups=[])
    {
        parent::__construct($name,$options);

        $this->setHydrator(new ClassMethods(true));
        $this->setObject(new ApplicationModel());

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
            'type' => 'Zend\Form\Element\Select',
            'name' => 'type',
            'options' => array(
                'label' => _("Type"),
                'value_options' => [
                    'spa' => 'SPA',
                    'meme' => 'Meme Machine',
                ],
            ),
            'attributes' => [
                'class' => 'form-control d-block',
            ],
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'comment',
            'options' => array(
                'label' => _("Comment"),
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
                'required' => false,
            ),
            'type' => array(
                'required' => true,
            ),
            'comment' => array(
                'required' => false,
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