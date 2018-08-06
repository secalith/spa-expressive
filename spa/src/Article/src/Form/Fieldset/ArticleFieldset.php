<?php

declare(strict_types=1);

namespace Article\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Article\Model\ArticleModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilter;

class ArticleFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $article_groups;

    public function __construct($name = null, $options = array(), $article_groups=[])
    {
        parent::__construct($name,$options);

        $this->setHydrator(new ClassMethods(true));
        $this->setObject(new ArticleModel());

        $this->article_groups = $article_groups;

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
            'type' => 'text',
            'name' => 'name',
            'options' => array(
                'label' => _("Internal name")
            ),
            'attributes' => [
                'class' => 'form-control d-block',
                'placeholder' => _("eg. Event in Warsaw in 26/08 (optional)"),
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
            'name' => 'article_type',
            'options' => array(
                'label' => _("Type"),
                'value_options' => [
                    'external' => _('External Site'),
                    'post' => _('Post'),
                ],
            ),
            'attributes' => [
                'class' => 'form-control d-block',
            ],
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'article_group',
            'options' => array(
                'label' => _("Group"),
                'value_options' => [
                    'article-group-001' => 'External Links'
                ],
            ),
            'attributes' => [
                'class' => 'form-control d-block',
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
            'article_group' => array(
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