<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/User for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace SinglePageApplication\Common\Controller;

use Zend\Stdlib\Hydrator;

use Common\Controller\CommonController as CommonController;


class Controller extends CommonController
{
    protected $data_item;

    /**
     * Constructor
     */
    public function __construct()
    {

    }


    /**
     * @return mixed
     */
    public function getDataItem()
    {
        return $this->data_item;
    }

    /**
     * @param mixed $data_item
     * @return Controller
     */
    public function setDataItem($data_item)
    {
        $this->data_item = $data_item;
        return $this;
    }

}
