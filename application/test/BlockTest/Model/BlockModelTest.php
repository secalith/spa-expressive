<?php

declare(strict_types=1);

namespace BlockTest\Model;

use Block\Model\BlockModel;
use PHPUnit\Framework\TestCase;

class BlockModelTest extends TestCase
{
    public function testDataExchangedIsExactToInputUsingConstructor()
    {

        $data = [
            'uid' => 'area-test-001',
            'parent_uid' => '0',
            'area_uid' => 'area-test-001',
            'template_uid' => 'template-test-001',
            'type' => 'list',
            'name' => 'page',
            'content' => 'page',
            'attributes' => '{}',
            'parameters' => '{}',
            'options' => '{}',
            'status' => 0,
            'order' => '1',
            'created' => date("Y-m-d H:i:s"),
            'updated' => null,
        ];

        $model = new BlockModel($data);

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
