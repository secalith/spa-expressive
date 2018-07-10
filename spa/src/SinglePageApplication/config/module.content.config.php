<?php
return array(
    'router' => array(
        'routes' => array(
            'content_update' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/singlepageapplication/content/edit[/:uid][/:response_type]',
                    'constraints' => array(
                        'uid' => '[a-zA-Z0-9_.-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'SinglePageApplication\Content\Controller\Update',
                        'action'     => 'update',
                        'response_type'     => 'http', // (http|ajax|api)
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'SinglePageApplication\Content\Controller\Update' => 'SinglePageApplication\Content\Controller\UpdateController',
        ),
        'delegators' => array(
            'SinglePageApplication\Content\Controller\Update' => array(
                'SinglePageApplication\Route\Controller\Delegator\RouteDelegatorFactory',
                'Common\Settings\Controller\Delegator\SettingsDelegatorFactory',
                'Common\DataSelector\Controller\Delegator\DataSelectorDelegatorFactory',
                'SinglePageApplication\Common\Controller\Delegator\ReadDelegatorFactory',
                'SinglePageApplication\Common\Controller\Delegator\WriteDelegatorFactory',
                'Common\Form\Controller\Delegator\FormDelegatorFactory',
                'Common\FormData\Controller\Delegator\FormDataDelegatorFactory',
                'SinglePageApplication\Page\Controller\Delegator\PageDelegatorFactory',
                'SinglePageApplication\Template\Controller\Delegator\DelegatorFactory',
                'SinglePageApplication\Area\Controller\Delegator\DelegatorFactory',
                'SinglePageApplication\Block\Controller\Delegator\DelegatorFactory',
                'SinglePageApplication\Content\Controller\Delegator\DelegatorFactory',
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'SinglePageApplication\Content\Model\ReadContentTable' => 'SinglePageApplication\Content\Service\Factory\ReadTableServiceFactory',
            'contentTableGateway' => 'SinglePageApplication\Content\Service\Factory\TableGatewayFactory',
        ),
    ),
    'form_elements' => array(
        'invokables' => array(
            'singlepageapplication_content.update' => 'SinglePageApplication\Content\Form\Form\UpdateForm',
        ),
    ),
);