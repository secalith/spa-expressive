<?php

declare(strict_types=1);

namespace ContentTest\Model;

use Content\Model\ContentModel;
use PHPUnit\Framework\TestCase;

class ContentModelTest extends TestCase
{
    public function testDataExchangedIsExactToInput()
    {

        $data = [
            'uid' => 'area-test-001',
            'parent_uid' => '0',
            'block_uid' => 'block-test-001',
            'template_uid' => 'template-test-001',
            'type' => 'list',
            'content' => 'page',
            'attributes' => '{}',
            'parameters' => '{}',
            'options' => '{}',
            'status' => 0,
            'order' => '1',
            'created' => date("Y-m-d H:i:s"),
            'updated' => null,
        ];

        $model = new ContentModel($data);

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
