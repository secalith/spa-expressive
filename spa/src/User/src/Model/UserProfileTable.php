<?php



namespace User\Model;

use Common\Model\GenerateUUIDTrait;
use User\Model\UserProfileModel;
use Zend\Db\TableGateway\TableGateway;

class UserProfileTable
{
    use GenerateUUIDTrait;

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function getItemByUid($uid)
    {
        $rowset = $this->tableGateway->select(array('uid' => $uid));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $uid");
        }
        return $row;
    }

    public function saveItem(UserProfileModel $item)
    {
        if( null === $item->getUid() || empty($item->getUid())) {
            $item->setUid($this->generateUUID());
        }

        $dateTime = new \DateTime('now');

        $data = array(
            'uid' => $item->getUid(),
            'name_first' => $item->getNameFirst(),
            'name_last' => $item->getNameLast(),
            'organization' => $item->getOrganization(),
            'created' => $dateTime->format('Y-m-d\TH:i:s.u'),
        );

        $rowsAffected = $this->tableGateway->insert($data);

        return [
            'affected' => $rowsAffected,
            'data' => $data,
        ];
    }

    public function updateItem(Entity $item)
    {

        $data = array(
            'uid' => $item->getUid(),
            'name_first' => $item->getNameFirst(),
            'name_last' => $item->getNameLast(),
            'route' => $item->getRoute(),
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
