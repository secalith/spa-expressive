<?php

declare(strict_types=1);

namespace Auth\Hydrator;

use Zend\Hydrator\AbstractHydrator;
use Zend\Hydrator\HydratorOptionsInterface;
use Zend\Stdlib\Exception;

class MapHydrator
    extends AbstractHydrator
    implements HydratorOptionsInterface
{
    protected $_dataMap = true;

    public function __construct($map)
    {
        parent::__construct();
        $this->_dataMap = $map;
    }

    public function setOptions($options)
    {
        return $this;
    }

    public function extract($object)
    {

    }

    public function hydrate(array $data, $object)
    {
        if (!is_object($object)) {
            throw new Exception\BadMethodCallException(sprintf(
                '%s expects the provided $object to be a PHP object)',
                __METHOD__
            ));
        }

        foreach ($data as $property => $value) {
            if (!property_exists($object, $property)) {
                if (in_array($property, array_keys($this->_dataMap))) {
                    $_prop = $this->_dataMap[$property];
                    $object->$_prop = $value;
                } else {
                    // unknown properties are skipped
                }
            } else {
                $object->$property = $value;
            }
        }

        return $object;
    }

}