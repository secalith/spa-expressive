<?php

declare(strict_types=1);

namespace AreaTest\Model;

use Area\Model\AreaModel;
use PHPUnit\Framework\TestCase;

class AreaModelTest extends TestCase
{
    public function testDataExchangedIsExactToInputUsingConstructor()
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

        $model = new AreaModel($data);

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
