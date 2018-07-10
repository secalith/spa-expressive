<?php

declare(strict_types=1);

namespace AreaTest\Model;

use Area\Model\AreaModel;
use Area\Model\AreaTable;
use Generic\Model\GenericTable;
use Generic\Model\Generic;
use Zend\Db\ResultSet\ResultSet;
use PHPUnit\Framework\TestCase;
use Zend\Db\Sql\Predicate\Predicate;
use Zend\Db\Sql\Select;
use \Mockery as m;

class AlbumTableTest extends TestCase
{
    protected $_mockTableGateway;
    protected $_mockGenericTable;
    protected $traceError = true;

    public function setup()
    {
        $this->_mockTableGateway = \Mockery::mock('Zend\Db\TableGateway\TableGateway');
        $this->_mockGenericTable = new \Generic\Model\GenericTable($this->_mockTableGateway);
    }

    public function tearDown()
    {
        m::close();
    }

    public function testGetsAverageTemperatureFromThreeServiceReadings()
    {
        $resultSet = new ResultSet();
        $mockTableGateway = \Mockery::mock('Zend\Db\TableGateway\TableGateway');
        $mockTableGateway->shouldReceive('select')->times(1)->andReturn($resultSet);
        $this->_mockGenericTable = new \Generic\Model\GenericTable($mockTableGateway);

        $this->assertEquals($resultSet, $this->_mockGenericTable->fetchAll());
    }

    public function testFetchAllByFirstName()
    {
        $resultSet = new ResultSet();
        $firstName = "Matthew";

        $mockSql = \Mockery::mock('Zend\Db\Sql');
        $mockSql->shouldReceive('where')->with(array("firstName" => $firstName))->times(1)->andReturn($mockSql);
        $this->_mockTableGateway->shouldReceive('getSql->select')->andReturn($mockSql);
        $this->_mockTableGateway->shouldReceive('select')->times(1)->with($mockSql)->andReturn($resultSet);

        $this->assertEquals($resultSet, $this->_mockGenericTable->fetchAllByFirstName($firstName));
    }

    public function testFetchComplexSelect()
    {
        $resultSet = new ResultSet();
        $firstName = "Matthew";
        $lastName = "Setter";

        $mockSql = \Mockery::mock('Zend\Db\Sql');
        $mockSql->shouldReceive('where')->with(
            array(
                "firstName" => $firstName,
                "lastName" => $lastName
            )
        )->times(1)->andReturn($mockSql);
        $mockSql->shouldReceive('where')->times(1)->andReturn($mockSql);
        $mockSql->shouldReceive('nest')->times(1)->andReturn($mockSql);
        $mockSql->shouldReceive('like')->with("email", "%gmail.com")->times(1)->andReturn($mockSql);
        $mockSql->shouldReceive('in')->with("age", array(4, 10, 20))->times(1)->andReturn($mockSql);
        $mockSql->shouldReceive('between')->with("income", 20000, 30000)->times(1)->andReturn($mockSql);
        $mockSql->shouldReceive('unnest')->times(1)->andReturn($mockSql);
        $mockSql->shouldReceive('order')->with("lastName DESC")->times(1)->andReturn($mockSql);

        $this->_mockTableGateway->shouldReceive('getSql')->andReturn($mockSql);
        $this->_mockTableGateway->shouldReceive('select')->with($mockSql)->andReturn($resultSet);
        $this->_mockTableGateway->shouldReceive('select')->times(1)->with($mockSql)->andReturn($resultSet);

        $this->assertEquals($resultSet, $this->_mockGenericTable->findByName($firstName));
    }

    public function testFetchByNameUsesFirstNameIfSupplied()
    {
        $resultSet = new ResultSet();
        $firstName = "Matthew";

        $mockSql = \Mockery::mock('Zend\Db\Sql');
        $mockSql->shouldReceive('where')->with(array("firstName" => $firstName))->times(1)->andReturn($mockSql);
        $mockSql->shouldReceive('order')->with("lastName DESC")->times(1)->andReturn($mockSql);

        $this->_mockTableGateway->shouldReceive('getSql->select')->andReturn($mockSql);
        $this->_mockTableGateway->shouldReceive('select')->times(1)->with($mockSql)->andReturn($resultSet);

        $this->assertEquals($resultSet, $this->_mockGenericTable->findByName($firstName));
    }

    public function testFetchByNameUsesLastNameIfSupplied()
    {
        $resultSet = new ResultSet();
        $lastName = "Matthew";

        $mockSql = \Mockery::mock('Zend\Db\Sql');
        $mockSql->shouldReceive('where')->with(array("lastName" => $lastName))->times(1)->andReturn($mockSql);
        $mockSql->shouldReceive('order')->with("lastName DESC")->times(1)->andReturn($mockSql);

        $this->_mockTableGateway->shouldReceive('getSql->select')->andReturn($mockSql);
        $this->_mockTableGateway->shouldReceive('select')->times(1)->with($mockSql)->andReturn($resultSet);

        $this->assertEquals($resultSet, $this->_mockGenericTable->findByName(null, $lastName));
    }

    public function testFetchByNameUsesBothNamesIfSupplied()
    {
        $resultSet = new ResultSet();
        $firstName = "Matthew";
        $lastName = "Setter";

        $mockSql = \Mockery::mock('Zend\Db\Sql');
        $mockSql->shouldReceive('where')
            ->with(array(
                "firstName" => $firstName,
                "lastName" => $lastName
            ))
            ->times(1)
            ->andReturn($mockSql);
        $mockSql->shouldReceive('order')->with("lastName DESC")->times(1)->andReturn($mockSql);

        $this->_mockTableGateway->shouldReceive('getSql->select')->andReturn($mockSql);
        $this->_mockTableGateway->shouldReceive('select')->times(1)->with($mockSql)->andReturn($resultSet);

        $this->assertEquals($resultSet, $this->_mockGenericTable->findByName($firstName, $lastName));
    }

    public function testFetchByNameUsesOrderByIfSupplied()
    {
        $resultSet = new ResultSet();
        $firstName = "Matthew";
        $lastName = "Setter";
        $orderBy = "firstName DESC";

        $mockSql = \Mockery::mock('Zend\Db\Sql');
        $mockSql->shouldReceive('where')
            ->with(array(
                "firstName" => $firstName,
                "lastName" => $lastName
            ))
            ->times(1)
            ->andReturn($mockSql);
        $mockSql->shouldReceive('order')->with($orderBy)->times(1)->andReturn($mockSql);

        $this->_mockTableGateway->shouldReceive('getSql->select')->andReturn($mockSql);
        $this->_mockTableGateway->shouldReceive('select')->times(1)->with($mockSql)->andReturn($resultSet);

        $this->assertEquals($resultSet, $this->_mockGenericTable->findByName($firstName, $lastName, $orderBy));
    }

    public function testFetchByNameUsesDefaultOrderByIfOneIsNotSupplied()
    {
        $resultSet = new ResultSet();
        $firstName = "Matthew";
        $lastName = "Setter";
        $orderBy = null;

        $mockSql = \Mockery::mock('Zend\Db\Sql');
        $mockSql->shouldReceive('where')
            ->with(array(
                "firstName" => $firstName,
                "lastName" => $lastName
            ))
            ->times(1)
            ->andReturn($mockSql);
        $mockSql->shouldReceive('order')->with("lastName DESC")->times(1)->andReturn($mockSql);

        $this->_mockTableGateway->shouldReceive('getSql->select')->andReturn($mockSql);
        $this->_mockTableGateway->shouldReceive('select')->times(1)->with($mockSql)->andReturn($resultSet);

        $this->assertEquals($resultSet, $this->_mockGenericTable->findByName($firstName, $lastName, $orderBy));
    }

    public function testFetchAllByFirstNameReturnsFalseWithEmptyFirstName()
    {
        $resultSet = new ResultSet();
        $firstName = "";

        $this->assertEquals(false, $this->_mockGenericTable->fetchAllByFirstName($firstName));
    }

    public function testFetchReturnRecordsWithAgeOverTwenty()
    {
        $resultSet = new ResultSet();
        $age = 21;

        $mockSql = \Mockery::mock('Zend\Db\Sql');
        $mockSql->shouldReceive('where')->with(array("age" => $age))->times(1)->andReturn($mockSql);
        $this->_mockTableGateway->shouldReceive('getSql->select')->andReturn($mockSql);
        $this->_mockTableGateway->shouldReceive('select')->times(1)->with($mockSql)->andReturn($resultSet);

        $this->assertEquals($resultSet, $this->_mockGenericTable->fetchReturnRecordsWithAgeOverTwenty($age));
    }

    public function testFetchSelect()
    {
        $orderClause = "lastName DESC";
        $whereArguments = array(
            "firstName" => "Michael",
            "lastName" => "Michael"
        );

        $resultSet = new ResultSet();
        $mockTableGateway = \Mockery::mock('Zend\Db\TableGateway\TableGateway');
        $mockSql = \Mockery::mock('Zend\Db\Sql');
        $mockSql->shouldReceive('select')->times(1)->andReturn($mockSql);
        $mockSql->shouldReceive('where')->with($whereArguments)->times(1)->andReturn($mockSql);
        $mockSql->shouldReceive('order')->with($orderClause)->times(1)->andReturn($mockSql);

        $mockTableGateway->shouldReceive('getSql')->andReturn($mockSql);
        $mockTableGateway->shouldReceive('select')->with($mockSql)->andReturn($resultSet);

        $mockGenericTable = new \Generic\Model\GenericTable($mockTableGateway);

        $this->assertEquals($resultSet, $mockGenericTable->fetchSelect());
    }

    public function testCannotDeleteRecordWithoutId()
    {
        $recordId = "";
        $this->assertEquals(false, $this->_mockGenericTable->deleteGeneric($recordId));
    }

    public function testCanDeleteRecordWithValidId()
    {
        $recordId = 22;
        $recordsDeleted = 1;
        $this->_mockTableGateway->shouldReceive('delete')
            ->times(1)
            ->with(array('id' => 22))
            ->andReturn($recordsDeleted);
        $this->assertEquals($recordsDeleted, $this->_mockGenericTable->deleteGeneric($recordId));
    }

    public function testSaveNewRecord()
    {
        $data = new Generic();
        $data->artist = "Matthew Setter";
        $data->title = "Artist";
        $data->id = 0;
        $insertCount = 1;

        $functionData = array(
            'artist' => $data->artist,
            'title'  => $data->title,
        );

        $this->_mockTableGateway->shouldReceive('insert')
            ->times(1)
            ->with($functionData)
            ->andReturn($insertCount);

        $this->assertEquals($insertCount, $this->_mockGenericTable->saveGeneric($data));
    }

    public function testUpdateExistingRecord()
    {
        $data = new Generic();
        $updateCount = 1;
        $functionData = array(
            'artist' => "Matthew Setter",
            'title'  => "Artist",
            'id'     => 12
        );

        $data->exchangeArray($functionData);

        $mockResultset = \Mockery::mock('Zend\Db\ResultSet\ResultSet[current,count]');

        $mockResultset->shouldReceive('current')
            ->times(1)
            ->andReturn($functionData);

        $mockResultset->shouldReceive('count')
            ->times(1)
            ->andReturn(1);

        $this->_mockTableGateway->shouldReceive('update')
            ->times(1)
            ->with(array(
                'artist' => $functionData['artist'],
                'title'  => $functionData['title']
            ),
                array('id' => $data->id)
            )
            ->andReturn($updateCount);

        $this->_mockTableGateway->shouldReceive('select')
            ->times(1)
            ->with(array('id' => $functionData['id']))
            ->andReturn($mockResultset);

        $this->assertEquals($updateCount, $this->_mockGenericTable->saveGeneric($data));
    }

    /**
     * @expectedException Exception
     */
    public function testUpdateNonexistentRecordThrowsException()
    {
        $data = new Generic();
        $updateCount = 1;
        $functionData = array(
            'artist' => "Matthew Setter",
            'title'  => "Artist",
            'id'     => 12
        );

        $data->exchangeArray($functionData);
        $mockResultset = \Mockery::mock('Zend\Db\ResultSet\ResultSet[current]');

        $this->_mockTableGateway->shouldReceive('select')
            ->times(1)
            ->with(array('id' => $functionData['id']))
            ->andReturn($mockResultset);

        $this->assertEquals($updateCount, $this->_mockGenericTable->saveGeneric($data));
    }

}