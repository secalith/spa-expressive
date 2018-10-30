<?php

namespace Common\Service;


use Zend\Db\TableGateway\TableGateway;

class PaginatorQueryService
{

    /**
     * @var TableGateway|null
     */
    protected $tableGateway;

    public function setTableGateway( TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;

        return $this;
    }

    /**
     * @param array $paginatorConfig
     * @return \Zend\Paginator\Paginator|null
     */
    public function makeQuery($paginatorConfig = [])
    {
        if(count($paginatorConfig)===0) {
            return null;
        }

        $sqlSelect = $this->tableGateway->getSql()->select();
        $sqlSelectQuery = $paginatorConfig['db_select'];
        $sqlSelect->columns($sqlSelectQuery['columns']);

        if(array_key_exists('join',$sqlSelectQuery)) {
            foreach($sqlSelectQuery['join'] as $sqlJoin) {
                $sqlSelect->join($sqlJoin['on'],$sqlJoin['where'],$sqlJoin['columns'],$sqlJoin['union']);
            }
        }

        if(array_key_exists('where',$sqlSelectQuery)) {
            $sqlSelect->where($sqlSelectQuery['where']);
        }

        if(array_key_exists('order',$sqlSelectQuery)) {
            $sqlSelect->order($sqlSelectQuery['order']);
        }

        $paginator = new $paginatorConfig['object'](
            new $paginatorConfig['adapter']['object'](
                $sqlSelect,
                $this->tableGateway->getAdapter(),
                $this->tableGateway->getResultSetPrototype()
            )
        );

        return $paginator;

    }
}