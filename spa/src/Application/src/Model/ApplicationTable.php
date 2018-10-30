<?php


declare(strict_types=1);

namespace Application\Model;

use Application\Model\ApplicationModel;

use Zend\Db\TableGateway\TableGateway;
use Common\Model\GenerateUUIDTrait;

class ApplicationTable
{
    use GenerateUUIDTrait;

    /**
     * @var TableGateway
     */
    protected $tableGateway;

    /**
     * PageTable constructor.
     * @param TableGateway $tableGateway
     */
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

    /**
     * @return \Zend\Db\ResultSet\ResultSet
     */
    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();

        $resultSet->buffer();
//        $resultSet->next();

        return $resultSet;
    }
    /**
     * @return \Zend\Db\ResultSet\ResultSet
     */
    public function fetchAllBy($where=[])
    {
        $resultSet = $this->tableGateway->select($where);

        $resultSet->buffer();
//        $resultSet->next();

        return $resultSet;
    }

    /**
     * @param string $uid
     * @return \Page\Model\PageModel
     */
    public function getItem(string $uid) : ApplicationModel
    {
        $rowset = $this->tableGateway->select(['uid' => $uid]);

        return $rowset->current();
    }

    /**
     * @param string|null $uid
     * @return array|\ArrayObject|int|null
     */
    public function getItemCount(string $uid = null)
    {
        if ($uid===null) {
            return 0;
        }

        if (is_array($uid)) {
            $rowset = $this->tableGateway->select($uid);
        } else {
            $rowset = $this->tableGateway->select(['uid' => $uid]);
        }

        return $rowset->current();
    }

    /**
     * @param $value
     * @param string $name
     * @return array|\ArrayObject|null
     */
    public function fetchBy($value, $name = "uid")
    {
        if(is_array($value)) {
            $rowset = $this->tableGateway->select($value);
        } else {
            $rowset = $this->tableGateway->select([$name => $value]);
        }

        return $rowset->current();
    }

    public function saveItem(ApplicationModel $item)
    {
        if( null === $item->getUid() || empty($item->getUid())) {
            $item->setUid($this->generateUUID());
        }

        $dateTime = new \DateTime('now');

        $data = array(
            'uid' => $item->getUid(),
            'type' => $item->getType(),
            'comment' => $item->getComment(),
            'status' => $item->getStatus(),
            'created' => $dateTime->format('Y-m-d H:i:s'),
        );

        $rowsAffected = $this->tableGateway->insert($data);


        return [
            'affected' => $rowsAffected,
            'data' => $data,
        ];

    }

    public function updateItem($selector,$data)
    {
        $rowsAffected = $this->tableGateway->update($data, $selector);

        return [
            'affected' => $rowsAffected,
            'data' => $data,
        ];
    }
}
