<?php

namespace App\Form;

use App\Entity\Category;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Hydrator\ClassMethods as ClassMethodsHydrator;

class CategoryFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct()
    {
        parent::__construct('category');

        $this
            ->setHydrator(new ClassMethodsHydrator(false))
            ->setObject(new Category())
        ;

        $this->setLabel('Category');

        $this->add(array(
            'name' => 'name',
            'options' => array(
                'label' => 'Name of the category',
            ),
            'attributes' => array(
                'required' => 'required',
            ),
        ));
    }

    /**
     * @return array
     */
    public function getInputFilterSpecification()
    {
        return array(
            'name' => array(
                'required' => true,
            ),
        );
    }
}
