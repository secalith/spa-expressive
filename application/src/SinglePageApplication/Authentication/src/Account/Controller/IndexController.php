<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/User for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Authentication\Account\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Zend\Stdlib\Hydrator;
use CiCommon\Controller\IndexController as CommonIndexController;

use Zend\Session\Container;

use Authentication\Form\Entity\LoginEntity as BaseEntity;

use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;

use Ramsey\Uuid\Uuid;

class IndexController extends CommonIndexController
{
    protected $module;
    protected $submodule;
    protected $action;
    protected $keyword;

    protected $serviceAPI;

    protected $serviceLog;

    /**
     *
     *
     * @var $filesService Files\Service\RackspaceService;
     */
    protected $filesService;
    
    /**
     * 
     * @var $ciBaseEntity
     */
    protected $ciBaseEntity;
    
    /**
     *
     * @var $ciL12Entity
     */
    protected $ciL12Entity;
    
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
     * Determine if system should use revisions or flat data structure
     * @var bool
     */
    protected $useRevisions = true;

    protected $translationDataFields = array('label','subject','body_html','body_txt');

    /**
     * Constructor
     */
    public function __construct() {
        /*
        $this->module = $config['module_name'];
        $this->submodule = $config['submodule_name'];
        $this->keyword = $config['submodule_name'];
        $this->matchedRouteName = $config['matched_route_name'];
        */
        $this->currentI18n = 'en_gb';
        $this->entity = new \stdClass();
        $this->hydrator = new Hydrator\ArraySerializable();

    }

    /**
     * Create New Resource
     *
     * @return ViewModel
     */
    public function accountAction()
    {
        $matchedModuleDataNamespace = sprintf('%s_%s',$this->getModuleName(),$this->submoduleName);
        $moduleSubmoduleName = $this->moduleName;
        $moduleSubmoduleFormName = sprintf('%s_login',$this->moduleName);
        $matchedRouteName = $this->getServiceLocator()->get('router')->match(
                $this->getServiceLocator()->get('request')
            )->getMatchedRouteName();
        $matchedRouteSuffix = substr($matchedRouteName,strrpos($matchedRouteName, '/')+1);

        // get config data, in order to use it in
        $config = $this->getServiceLocator()->get('Config');
        // parent_uid is obtained from $_GET, if parent_uid ids not present then default to 0 [which stands for root]
        $parentUid = (!empty((string)$this->params('parent_uid')))?(string)$this->params('parent_uid'):0;

        if ($this->getRequest()->isPost()) {

            $this->getServiceLog()->debug(sprintf('%s addAction() POST data submitted',__NAMESPACE__));
            $forms = $this->getFormAsset();
            $formCreate = $forms[$moduleSubmoduleFormName]['form'];
            // bind entity data and posted data to the form object
            $entity = new BaseEntity();
            $formCreate->bind($entity);
            $formCreate->setData($this->getRequest()->getPost());

            // check for form validation
            if ($formCreate->isValid()) {

                $serviceAPI = $this->getServiceLocator()->get("authentication_api");
                $authenticateUrl = $config['api_endpoints']['api_authentication']['children']['login_profile'];
                $responseAuthenticateService = $serviceAPI->post($authenticateUrl,$formCreate->getData()->getLogin()->toArray());

                if(array_key_exists('status',$responseAuthenticateService)
                    && 201 === $responseAuthenticateService['status']) {
                    // user credentials are valid

                } else {

                }

            } else {
                var_dump($formCreate->getMessages());
                echo 'not valid';
            }
        }

        var_dump($this->getFormViewConfig());

        $viewModel = new ViewModel(
            array(
                'keyword' => $this->getKeywordName(),
                'module' => $this->getModuleName(),
                'submodule' => $this->getSubmoduleName(),
                'form'=>$this->getFormAsset(),
                'routeView' => $this->getRouteViewConfig($moduleSubmoduleFormName),
                'formView' => $this->getFormViewConfig(),
                'flashMessages' => $this->flashMessenger()->getMessages(),
                'matchedRouteName' => $matchedRouteName,
                'matchedRouteSuffix'=> $matchedRouteSuffix,
                'matchedModuleDataNamespace' => $matchedModuleDataNamespace,
                'moduleFormLocation' => $moduleSubmoduleFormName,
            )
        );

        $viewModel->setTemplate(sprintf("%s/index/details.phtml",$this->submoduleName));

        $this->layout('authentication/layout/layout');

        return $viewModel;
    } // addAction()

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
