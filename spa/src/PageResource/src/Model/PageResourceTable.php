<?php



namespace PageResource\Model;

use Common\Model\GenerateUUIDTrait;
use Site\Model\SiteModel as SiteModel;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;

class PageResourceTable
{

    use GenerateUUIDTrait;

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function listAll()
    {

        $order = "DESC";

        $sql = $this->tableGateway->getSql();
        $sqlSelect = $sql->select();
//        $sqlSelect->columns(array('column_name'));
//        $sqlSelect->join('route_routes', 'route_routes.route_uid = page.route', array(), 'inner');



        $sqlSelect->order('name' . ' ' . $order);

        $resultSet = $this->tableGateway->selectWith($sqlSelect);

        $resultSet->buffer();

        return $resultSet;
    }

    public function getItem($uid)
    {
        $rowset = $this->tableGateway->select(array('uid' => $uid));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $uid");
        }
        return $row;
    }
    public function fetchBy($value, $name = "uid",$muteException=false)
    {
        $rowset = $this->tableGateway->select(array($name => $value));
        $row = $rowset->current();
        if ($muteException===false&&!$row) {
            throw new \Exception("Could not find row $value");
        }
        return $row;
    }
}
