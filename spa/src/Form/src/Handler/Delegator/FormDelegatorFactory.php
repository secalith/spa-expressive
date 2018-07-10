<?php
namespace Form\Delegator;

use Zend\ServiceManager\DelegatorFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Interop\Container\ContainerInterface;
use Form\FormAwareInterface;
        
/**
 * Class FormDelegatorFactory
 *
 * If in config there is entry application->{current_route_name}->forms then
 *
 * @package App\Delegator
 */
class FormDelegatorFactory implements DelegatorFactoryInterface
{

    /**
     * @param ContainerInterface $container
     * @param string $name
     * @param callable $callback
     * @param array|null $options
     * @return callable|mixed
     */
    public function __invoke(ContainerInterface $container, $name, callable $callback, array $options = null)
    {
        // The callback must implement
        if ( ! call_user_func($callback) instanceof FormAwareInterface) {
            return call_user_func($callback);
        }

        $config = $container->has('config') ? $container->get('config') : [];
        $currentRouteName = $container->get(\Common\Helper\RouteHelper::class)->getMatchedRouteName();

        // try to get the applications config attached to the routeName
        if (array_key_exists('application', $config)
            && array_key_exists('form', $config['application']['module'])
            && array_key_exists($currentRouteName, $config['application']['module']['form'])) {

            // get 'forms' config by the routeName
            if (array_key_exists('post', $config['application']['module']['form'][$currentRouteName])) {
                // Load the form by the RouteName into local variable
                $formsDeclarationConfig = $config['application']['module']['form'][$currentRouteName]['post'];
                if (! empty($formsDeclarationConfig)) {
                    // there is some forms attached to the current route
                    foreach ($formsDeclarationConfig as $formDeclaration) {
                        // Get the name of the Form Object attached to the route
                        $formDeclarationClass = $formDeclaration['fdqn'];
                        if (is_string($formDeclarationClass)) {
                            $f = new $formDeclarationClass();
                            // as the called action is FormAware, add the current form to it
                            $callback = call_user_func($callback)->addForm($f, $formDeclaration['name']);
                        }
                    }
                }
            }
        }

        // callback has been initiated already
        if ($callback instanceof FormAwareInterface) {
            return $callback;
        }

        return call_user_func($callback);
    }

    public function createDelegatorWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName, $callback)
    {}
}
