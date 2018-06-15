<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/User for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Authentication\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Zend\Stdlib\Hydrator;
use Common\Controller\CommonController as CommonIndexController;
use Zend\Session\Container;

use Authentication\Adapter\ApiAuthenticationAdapter as AuthAdapter;
use Zend\Authentication\AuthenticationService;

use Authentication\Form\Entity\LoginEntity as BaseEntity;

use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;


class CommonController extends CommonIndexController
{
    protected $module;
    protected $submodule;
    protected $action;
    protected $keyword;

    protected $serviceAPI;

    protected $serviceLog;
    
    /**
     *
     * @var string
     */
    protected $matchedRouteName;
    
    /**
     *
     * @var string
     */
    protected $routeMatch;
    
    /**
     *
     * @var array
     */
    protected $response;

    /**
     *
     */
    protected $responseAPI;

    /**
     *
     * @var array
     */
    protected $dataItems;
    
    /**
     *
     * @var string
     */
    protected $currentI18n;

    protected $authservice;

    /**
     * 
     * @var object \stdClass
     */
    protected $entity;
    
    /**
     *
     * @var object Hydrator\ArraySerializable
     */
    protected $hydrator;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->currentI18n = 'en_gb';
        $this->entity = new \stdClass();
        $this->hydrator = new Hydrator\ArraySerializable();

    }

    public function getAuthService()
    {
        if (! $this->authservice) {
            $this->authservice = $this->getServiceLocator()
                ->get('AuthService');
        }
        return $this->authservice;
    }

    public function getSessionStorage()
    {
        if (! $this->storage) {
            $this->storage = $this->getServiceLocator()
                ->get('Authentication\Model\AuthStorage');
        }
        return $this->storage;
    }

    /**
     * Return merged params from query [GET] and from route
     *
     * @return array
     */
    public function getParams()
    {
        $config = array();
        $paramsFromQuery = $this->getServiceLocator()->get('request')->getQuery()->toArray();
        $paramsFromRoute = $this->getServiceLocator()->get('router')->match(
            $this->getServiceLocator()->get('request')
        )->getParams();
        unset($paramsFromRoute['controller']);
        $config = \Zend\Stdlib\ArrayUtils::merge($config, $paramsFromRoute);
        if(!empty($paramsFromQuery)) {
            // foreach ($paramsFromQuery as $paramFromQuery) {
            // var_dump($paramsFromRoute);
            $config = \Zend\Stdlib\ArrayUtils::merge($config, $paramsFromQuery);
            //}
        }

        return $config;
    }
}
