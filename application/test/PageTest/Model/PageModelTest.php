<?php

declare(strict_types=1);

namespace PageTest\Model;

use Page\Model\PageModel;
use PHPUnit\Framework\TestCase;

class PageModelTest extends TestCase
{
    public function testDataExchangedIsExactToInputUsingConstructor()
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

        $model = new PageModel($data);

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
