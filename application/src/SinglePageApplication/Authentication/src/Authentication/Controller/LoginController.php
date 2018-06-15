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
use Common\Controller\CommonController as CommonController;

use Zend\Session\Container;

use Authentication\Adapter\ApiAuthenticationAdapter as AuthAdapter;
use Zend\Authentication\AuthenticationService;

use Authentication\Form\Entity\LoginEntity as BaseEntity;

class LoginController extends CommonController
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
    public function loginAction()
    {

        $auth = new AuthenticationService();

        $loggedInUser = $auth->getIdentity();

        if( ! empty($loggedInUser)) {
            $this->flashMessenger()->addInfoMessage('You are already logged in. To see this template logout first');
            return $this->redirect()->toRoute('member_admin');
        }

        $v = new ViewModel(
            array(
                'module' => $this->getModuleName(),
                'submodule' => $this->getSubmoduleName(),
                'form'=>$this->getForm(),
            )
        );

        //$viewModel->setTemplate(sprintf("%s/login/login.phtml",$this->getModuleName()));

        $this->layout('authentication/layout/layout');

        return $v;

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
