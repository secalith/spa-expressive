<?php

declare(strict_types=1);

namespace PageTemplateTest\Model;

use PageTemplate\Model\PageTemplateModel;
use PHPUnit\Framework\TestCase;

class PageTemplateModelTest extends TestCase
{
    public function testDataExchangedIsExactToInputUsingConstructor()
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

        $model = new PageTemplateModel($data);

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
