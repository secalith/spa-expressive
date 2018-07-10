<?php

declare(strict_types=1);

namespace Common;

use Common\Helper\CurrentRouteNameHelper;
use Common\Helper\Factory\CurrentRouteNameHelperFactory;
use Common\View\Helper\Factory\DisplayLinkGroupHelperFactory;
use Common\Middleware\CurrentRouteNameMiddleware;
use Common\Middleware\CurrentUrlMiddleware;
use Common\Middleware\Factory\CurrentRouteNameMiddlewareFactory;
use Common\Middleware\Factory\CurrentUrlMiddlewareFactory;
use Common\Middleware\Factory\HandlerCacheMiddlewareFactory;
use Common\Middleware\Factory\StaticPageHandlerCacheMiddlewareFactory;
use Common\Middleware\HandlerCacheMiddleware;
//use Common\Middleware\PostRedirectGet;
use Common\Middleware\StaticPageHandlerCacheMiddleware;
use Common\View\Helper\CurrentUrlHelper;
use Common\View\Helper\Factory\CurrentUrlHelperFactory;
use Common\View\Helper\FlashMessage;
use Common\View\Helper\GetFormAttached;
use Common\View\Helper\IsFormSet;
use Whoops\Handler\Handler;
use Zend\Session\Storage\SessionArrayStorage;
use Zend\Session\Validator\HttpUserAgent;
use Zend\Session\Validator\RemoteAddr;

class ConfigProvider
{

    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
            'view_helpers'  => [
                'invokables' => [
                    'isFormSet' => IsFormSet::class,
                    'getFormAttached' => GetFormAttached::class,
                    'flashMessage' => FlashMessage::class,
                    'closeTag' => View\Helper\CloseTagHelper::class,
                ],
                'factories' => [
                    'currentRoute' => CurrentUrlHelperFactory::class,
                    'displayLinkGroup' => DisplayLinkGroupHelperFactory::class,
                    'openTag' => View\Helper\OpenTagHelperFactory::class,
                ],

            ],
            'session_config' => [
                'cookie_lifetime' => 60*60*100,
                'gc_maxlifetime' => 60*60*24*300,
            ],
            'session_manager' => [
                'validators' => [
                    RemoteAddr::class,
                    HttpUserAgent::class,
                ]
            ],
            'session_storage' => [
                'type' => SessionArrayStorage::class
            ],
            'cache' => [
                'enabled' => true,
                'path' => 'data/cache/',
                'lifetime' => 3600
            ],
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies() : array
    {
        return [
            'invokables' => [
                CurrentUrlHelper::class => CurrentUrlHelper::class,

            ],
            'factories' => [
                CurrentUrlMiddleware::class => CurrentUrlMiddlewareFactory::class,
                CurrentRouteNameMiddleware::class => CurrentRouteNameMiddlewareFactory::class,
                CurrentRouteNameHelper::class => CurrentRouteNameHelperFactory::class,
                StaticPageHandlerCacheMiddleware::class => StaticPageHandlerCacheMiddlewareFactory::class,
            ],
            'abstract_factories' => [
                Service\GatewayAbstractFactory::class,
                Service\TableServiceAbstractFactory::class,
                \Common\Handler\Factory\CreateHandlerAbstractFactory::class,
//                \Common\Handler\Factory\ReadHandlerAbstractFactory::class,
//                \Common\Handler\Factory\UpdateHandlerAbstractFactory::class,
//                \Common\Handler\Factory\DeleteHandlerAbstractFactory::class,
                \Common\Handler\Factory\ListHandlerAbstractFactory::class,
            ],
            'delegators' => [
                \Zend\Expressive\Application::class => [
                    \Common\Application\Factory\PipelineAndRoutesDelegator::class,
                ],
                'Common\Handler\Create' => [
                    \Common\Handler\Delegator\ApplicationConfigAwareDelegator::class,
                    \Common\Handler\Delegator\ApplicationFormAwareDelegator::class,
                    \Common\Handler\Delegator\ApplicationFieldsetSaveServiceAwareDelegator::class,
                ],
//                'Common\Handler\Read' => [
//                    \Common\Handler\Delegator\ApplicationConfigAwareDelegator::class,
//                    \Common\Handler\Delegator\ApplicationFormAwareDelegator::class,
//                    \Common\Handler\Delegator\ApplicationFieldsetSaveServiceAwareDelegator::class,
//                ],
//                'Common\Handler\Update' => [
//                    \Common\Handler\Delegator\ApplicationConfigAwareDelegator::class,
//                    \Common\Handler\Delegator\ApplicationFormAwareDelegator::class,
//                    \Common\Handler\Delegator\ApplicationFieldsetSaveServiceAwareDelegator::class,
//                ],
//                'Common\Handler\Delete' => [
//                    \Common\Handler\Delegator\ApplicationConfigAwareDelegator::class,
//                    \Common\Handler\Delegator\ApplicationFormAwareDelegator::class,
//                    \Common\Handler\Delegator\ApplicationFieldsetSaveServiceAwareDelegator::class,
//                ],
            ],
        ];
    }

    public function getTemplates()
    {
        return [
            'paths' => [
                'common' => [__DIR__ . '/../templates/common'],
                'common-admin' => [__DIR__ . '/../templates/common-admin'],
                'common-admin-partial' => [__DIR__ . '/../templates/common-admin/common-admin-partial'],
            ],
        ];
    }

}
