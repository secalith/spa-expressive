<?php

declare(strict_types=1);

namespace AreaTest\Model;

use Area\Model\AreaModel;
use PHPUnit\Framework\TestCase;
use Zend\Filter\Word\UnderscoreToCamelCase;

class AreaModelTest extends TestCase
{

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        $data = [
            'uid' => 'area-test-001',
            'template_uid' => 'template-test-001',
            'machine_name' => 'area_test_001',
            'scope' => 'page',
            'attributes' => '{}',
            'parameters' => '{}',
            'options' => '{}',
            'status' => 0,
            'order' => '1',
            'created' => date("Y-m-d H:i:s"),
            'updated' => null,
        ];

        parent::__construct($name,$data,$dataName);
    }

    public function testDataExchangedIsExactToInputUsingConstructorMethod()
    {
        $model = new AreaModel($this->getProvidedData());

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
        $model = new AreaModel();
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
        $model = new AreaModel();

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
        $model = new AreaModel($this->getProvidedData());

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
        $model = new AreaModel();

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
        $model = new AreaModel();

        $underscoreToCamelCaseFilter = new UnderscoreToCamelCase();

        foreach($this->getProvidedData() as $name => $value) {
            $setterName =  sprintf(
                "set%s",
                $underscoreToCamelCaseFilter->filter($name)
            );
            // check if getter method exists
            $this->assertEquals(AreaModel::class,get_class($model->{$setterName}('data')));
        }
    }

    public function testDataExchangeSettersEqualsGetters()
    {
        $underscoreToCamelCaseFilter = new UnderscoreToCamelCase();

        foreach($this->getProvidedData() as $name => $value) {
            $model = new AreaModel();
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

    public function testEmptySetterArgumentCausesException()
    {
        $underscoreToCamelCaseFilter = new UnderscoreToCamelCase();
#TODO why it tests only once? Ignoring foreach?
        foreach($this->getProvidedData() as $name => $value) {
            $model = new AreaModel();
            $setterName =  sprintf(
                "set%s",
                $underscoreToCamelCaseFilter->filter($name)
            );
            $this->expectException(\ArgumentCountError::class);

            $model->{$setterName}();

        }

    }
}
