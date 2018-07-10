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
use Authentication\Controller\CommonController as CommonController;

use Zend\Session\Container;

use Authentication\Adapter\ApiAuthenticationAdapter as AuthAdapter;
use Zend\Authentication\AuthenticationService;

use Authentication\Form\Entity\LoginEntity as BaseEntity;

use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;

use Ramsey\Uuid\Uuid;

class IndexController extends CommonController
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();

    }

    /**
     * Create New Resource
     *
     * @return ViewModel
     */
    public function changeTranslationAction()
    {
        $params = $this->getParams();
        $matchedModuleDataNamespace = sprintf('%s_%s',$this->getModuleName(),$this->submoduleName);

        $moduleSubmoduleFormName = sprintf('%s_login',$this->moduleName);
        $matchedRouteName = $this->getServiceLocator()->get('router')->match(
                $this->getServiceLocator()->get('request')
            )->getMatchedRouteName();
        $matchedRouteSuffix = substr($matchedRouteName,strrpos($matchedRouteName, '/')+1);

        // get config data, in order to use it in
        $config = $this->getServiceLocator()->get('Config');

        $auth = new AuthenticationService();
        
        $loggedInUser = $auth->getIdentity();

        if( ! empty($loggedInUser)) {
            $this->flashMessenger()->addInfoMessage('You are already logged in. To see this template logout first');
            return $this->redirect()->toRoute('member_admin');
        }

        if ($this->getRequest()->isPost()) {

            $this->getServiceLog()->debug(sprintf('%s addAction() POST data submitted',__NAMESPACE__));
            $forms = $this->getFormAsset();
            $form = $forms[$moduleSubmoduleFormName]['form'];
            // bind entity data and posted data to the form object
            $entity = new BaseEntity();
            $form->bind($entity);
            $form->setData($this->getRequest()->getPost());

            // check for form validation
            if ($form->isValid()) {
                $data = $form->getData()->getLogin()->toArray();
                $serviceAPI = $this->getServiceLocator()->get("authentication_api");
                $authenticateUrl = $config['api_endpoints']['api_authentication']['children']['login_profile'];
                $responseAuthenticateService = $serviceAPI->post($authenticateUrl,$data);

                if(isset($responseAuthenticateService['data'])&&null!==$responseAuthenticateService['data']) {
                    // user credentials are valid
                    $auth = new AuthenticationService();
                    $authAdapter = new AuthAdapter($data['username'], $data['password']);
                    $result = $auth->authenticate($authAdapter);

                    $this->flashMessenger()->addSuccessMessage('You have logged in.');
                    return $this->redirect()->toRoute('member_admin');
                } else {
                    $this->flashMessenger()->addWarningMessage('Password or username is incorrect.');
                    return $this->redirect()->toRoute('authentication/login');
                }

            } else {
                //echo 'not valid';
            }
        }

        $viewModel = new ViewModel(
            array(
                'keyword' => $this->getKeywordName(),
                'module' => $this->getModuleName(),
                'submodule' => $this->getSubmoduleName(),
                'form'=>$this->getFormAsset(),
                'routeView' => $this->getRouteViewConfig($moduleSubmoduleFormName),
                'formView' => $this->getFormViewConfig(),
                'matchedRouteName' => $matchedRouteName,
                'matchedRouteSuffix'=> $matchedRouteSuffix,
                'matchedModuleDataNamespace' => $matchedModuleDataNamespace,
                'moduleFormLocation' => $moduleSubmoduleFormName,
            )
        );

        $viewModel->setTemplate(sprintf("%s/login/login.phtml",$this->getModuleName()));

        $this->layout('authentication/layout/layout');

        return $viewModel;
    } // addAction()


    public function logoutAction()
    {
        $auth = new AuthenticationService();

        $loggedInUser = $auth->getIdentity();

        $sm = $this->getServiceLocator();
        $request = $this->getRequest();
        $routeMatch = $this->getEvent()->getRouteMatch()->getParams();

        // inititate loaded object with inline script
        $inlineScript = $this->getServiceLocator()->get('viewhelpermanager')
            ->get('inlineScript');
        $urlRedirectTo = '/';
        // code will be automatically inserted by the appendScript method.
        $inlineScript->appendScript(
        // change to to wherever ci-register.js is located
            'window.setTimeout(function(){

            // Move to a new location or you can do something else
            window.location.href = "'.$urlRedirectTo.'";

        }, 5000);',
            'text/javascript',
            array('noescape' => true)); // Disable CDATA comments

        $auth->clearIdentity();

        $this->flashMessenger()->addSuccessMessage('You have logged out.');

        return array();
    }
}
