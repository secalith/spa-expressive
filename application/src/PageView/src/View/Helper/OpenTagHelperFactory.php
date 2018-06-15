<?php

declare(strict_types=1);

namespace Common\View\Helper\Factory;

use Common\View\Helper\OpenTagHelper;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Helper\AbstractHelper;

class OpenTagHelperFactory extends AbstractHelper implements FactoryInterface
{
    private $sm;

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $this->sm = $serviceLocator;
        return $this;
    }

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
//        $routeName = $container->get(\Common\Helper\RouteHelper::class)->getMatchedRouteName();
//
        $displayMode = 'display';
//
//        if($routeName==='page.edit') {
            // obtain the real routeName from the UID
//            $matchedParams = $container->get(\Common\Helper\RouteHelper::class)
//                ->getRouteResult()->getMatchedParams();
//            if(array_key_exists('uid',$matchedParams)) {
//                $displayMode = 'edit';
//            }
//        }

        return new OpenTagHelper($displayMode);
    }
}
