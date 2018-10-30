<?php
namespace Form\Delegator;

use Zend\ServiceManager\DelegatorFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Interop\Container\ContainerInterface;
use Form\FormFactoryAwareInterface;
use Zend\Expressive\Helper;
use Zend\Form\Factory as FormFactory;

/**
 * If the requested Class is FormFactoryAware then
 *
 * Class FormFactoryDelegatorFactory
 * @package App\Delegator
 */
class FormFactoryDelegatorFactory implements DelegatorFactoryInterface
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
        if (! call_user_func($callback) instanceof FormFactoryAwareInterface) {
            return call_user_func($callback);
        }
        $callback = call_user_func($callback);

        $factory = new FormFactory($container->get('FormElementManager'));
        $inputFilters = $container->get('InputFilterManager');
        $factory->getInputFilterFactory()->setInputFilterManager($inputFilters);
        ($callback)->setFormFactory($factory);

        if ($callback instanceof FormFactoryAwareInterface) {
            return $callback;
        }

        return ($callback);
    }

    public function createDelegatorWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName, $callback)
    {}
}
