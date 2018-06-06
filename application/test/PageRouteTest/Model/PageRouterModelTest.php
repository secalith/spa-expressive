<?php

declare(strict_types=1);

namespace PageRouteTest\Model;

use PageRoute\Model\RouterModel;
use PHPUnit\Framework\TestCase;

class PageRouterModelTest extends TestCase
{
    public function testDataExchangedIsExactToInputUsingConstructor()
    {

        $data = [
            'uid' => 'area-test-001',
            'parent_uid' => '0',
            'route_uid' => 'route-test-001',
            'route_url' => '/page',
            'scenario' => 'Route #1',
            'controller' => 'Controller',
            'attributes' => '{}',
            'status' => 0,
            'created' => date("Y-m-d H:i:s"),
            'updated' => null,
        ];

        $model = new RouterModel($data);

        $modelArray = $model->toArray();

        $this->assertCount(count($data),$modelArray);

        foreach($data as $name => $value) {
            $this->assertArrayHasKey($name,$modelArray);
            $this->assertEquals($value,$modelArray[$name]);
        }

        $this->assertInternalType("int", $modelArray['status']);

        $this->assertEmpty($modelArray['updated']);

    }
}
