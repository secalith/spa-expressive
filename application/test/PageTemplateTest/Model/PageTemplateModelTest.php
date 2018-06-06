<?php

declare(strict_types=1);

namespace PageTemplateTest\Model;

use PageTemplate\Model\PageTemplateModel;
use PHPUnit\Framework\TestCase;
use Zend\Filter\Word\UnderscoreToCamelCase;

class PageTemplateModelTest extends TestCase
{
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        $data = [
            'uid' => 'template-test-001',
            'name' => 'template_test_001',
            'type' => 'filesystem',
            'location' => 'page-view',
            'label' => 'Template Test #1',
            'status' => 0,
            'created' => date("Y-m-d H:i:s"),
            'updated' => null,
        ];

        parent::__construct($name,$data,$dataName);
    }

    public function testDataExchangedIsExactToInputUsingConstructorMethod()
    {
        $model = new PageTemplateModel($this->getProvidedData());

        $modelArray = $model->toArray();

        $this->assertCount(count($this->getProvidedData()),$modelArray);

        foreach($this->getProvidedData() as $name => $value) {
            $this->assertArrayHasKey($name,$modelArray);
            $this->assertEquals($value,$modelArray[$name]);
        }

        $this->assertInternalType("int", $modelArray['status']);

        $this->assertNull($modelArray['updated']);

    }

    public function testDataExchangedIsExactToInputUsingExchangeArrayMethod()
    {
        $model = new PageTemplateModel();
        $model->exchangeArray($this->getProvidedData());

        $modelArray = $model->toArray();

        $this->assertCount(count($this->getProvidedData()),$modelArray);

        foreach($this->getProvidedData() as $name => $value) {
            $this->assertArrayHasKey($name,$modelArray);
            $this->assertEquals($value,$modelArray[$name]);
        }

        $this->assertInternalType("int", $modelArray['status']);

        $this->assertNull($modelArray['updated']);

    }


    public function testGettersExists()
    {
        $model = new PageTemplateModel();

        $underscoreToCamelCaseFilter = new UnderscoreToCamelCase();

        foreach($this->getProvidedData() as $name => $value) {
            $getterName =  sprintf(
                "get%s",
                $underscoreToCamelCaseFilter->filter($name)
            );
            // check if getter method exists
            $this->assertTrue(method_exists($model,$getterName));
        }
    }

    public function testDataExchangedGetters()
    {
        $model = new PageTemplateModel($this->getProvidedData());

        $modelArray = $model->toArray();

        $this->assertCount(count($this->getProvidedData()),$modelArray);

        $underscoreToCamelCaseFilter = new UnderscoreToCamelCase();

        foreach($this->getProvidedData() as $name => $value) {
            $getterName =  sprintf(
                "get%s",
                $underscoreToCamelCaseFilter->filter($name)
            );
            // check if getter value is same
            $this->assertEquals($value,$model->{$getterName}());
        }
    }

    public function testSettersExists()
    {
        $model = new PageTemplateModel();

        $underscoreToCamelCaseFilter = new UnderscoreToCamelCase();

        foreach($this->getProvidedData() as $name => $value) {
            $setterName =  sprintf(
                "set%s",
                $underscoreToCamelCaseFilter->filter($name)
            );
            // check if getter method exists
            $this->assertTrue(method_exists($model,$setterName));
        }
    }

    public function testSettersReturnsSameClassName()
    {
        $model = new PageTemplateModel();

        $underscoreToCamelCaseFilter = new UnderscoreToCamelCase();

        foreach($this->getProvidedData() as $name => $value) {
            $setterName =  sprintf(
                "set%s",
                $underscoreToCamelCaseFilter->filter($name)
            );
            // check if getter method exists
            $this->assertEquals(PageTemplateModel::class,get_class($model->{$setterName}('data')));
        }
    }

    public function testDataExchangeSettersEqualsGetters()
    {
        $underscoreToCamelCaseFilter = new UnderscoreToCamelCase();

        foreach($this->getProvidedData() as $name => $value) {
            $model = new PageTemplateModel();
            $setterName =  sprintf(
                "set%s",
                $underscoreToCamelCaseFilter->filter($name)
            );
            $getterName =  sprintf(
                "get%s",
                $underscoreToCamelCaseFilter->filter($name)
            );

            $this->assertEquals($value,$model->{$setterName}($value)->{$getterName}());
        }
    }
}
