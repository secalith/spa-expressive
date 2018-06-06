<?php

declare(strict_types=1);

namespace PageRouteTest\Model;

use PageRoute\Model\RouteModel;
use PHPUnit\Framework\TestCase;

class PageRouteModelTest extends TestCase
{
    public function testDataExchangedIsExactToInputUsingConstructor()
    {

        $data = [
            'uid' => 'area-test-001',
            'route_name' => 'Route #1',
            'status' => 0,
            'created' => date("Y-m-d H:i:s"),
            'updated' => null,
        ];

        $model = new RouteModel($data);

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
