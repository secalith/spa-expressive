<?php



namespace Site\Model;

use Common\Model\GenerateUUIDTrait;
use Site\Model\SiteModel as SiteModel;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;

class SiteTable
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

    public function fetchAll()
    {
        // check if cache is present
        if (null!==$this->cache
            && null!==$this->cache->getItem($this->cache_namespace)) {
            $result = $this->cache->getItem($this->cache_namespace);
        } else {
            $resultSet = $this->tableGateway->select();
            foreach ($resultSet as $item) {
                $result[$item->getName()] = $item;
            }
            if (null!==$this->cache) {
                $this->cache->removeItem($this->cache_namespace);
                $this->cache->setItem($this->cache_namespace, $result);
            }
        }
        return $result;
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

    public function saveItem(SiteModel $item)
    {
        if( null === $item->getUid() || empty($item->getUid())) {
            $item->setUid($this->generateUUID());
        }

        $dateTime = new \DateTime('now');

        $data = array(
            'uid' => $item->getUid(),
            'email' => $item->getEmail(),
            'status' => 1,
            'created' => $dateTime->format('Y-m-d\TH:i:s.u'),
        );

        $rowsAffected = $this->tableGateway->insert($data);


        return [
            'affected' => $rowsAffected,
            'data' => $data,
        ];


    }

    public function updateItem(SiteModel $item)
    {

        $data = array(
            'uid' => $item->getUid(),
            'name' => $item->getName(),
            'template' => $item->getTemplate(),
            'route' => $item->getRoute(),
            'route_url' => $item->getRouteUrl(),
            'page_cache' => $item->getPageCache(),
        );

        $uid = $item->getUid();

        if (null!==$uid&&0===$uid) {
            throw new \Exception('Item\'s uid cannot be null');
        } else {
            if ($this->getItem($uid)) {
                $this->tableGateway->update($data, array('uid' => $uid));
            } else {
                throw new \Exception('Item\'s uid does not exist');
            }
        }
    }

    public function deleteItem($uid)
    {
        $this->tableGateway->delete(array('uid' => $uid));
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
