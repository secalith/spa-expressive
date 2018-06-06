<?php

declare(strict_types=1);

namespace PageTest\Model;

use Page\Model\PageModel;
use PHPUnit\Framework\TestCase;
use Zend\Filter\Word\UnderscoreToCamelCase;

class PageModelTest extends TestCase
{
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        $data = [
            'uid' => 'area-test-001',
            'route_uid' => 'route-test-001',
            'template_uid' => 'template-test-001',
            'name' => 'Page #1',
            'route_url' => '/page',
            'page_cache' => '0',
            'status' => 0,
            'created' => date("Y-m-d H:i:s"),
            'updated' => null,
        ];

        parent::__construct($name,$data,$dataName);
    }

    public function testDataExchangedIsExactToInputUsingConstructorMethod()
    {
        $model = new PageModel($this->getProvidedData());

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
        $model = new PageModel();
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
        $model = new PageModel();

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
        $model = new PageModel($this->getProvidedData());

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
        $model = new PageModel();

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
}
