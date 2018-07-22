<?php

namespace ArrayDigger\Service;

/**
 * Extracts data from array or object by given path
 *
 * Class ArrayDigger
 * @package ArrayDigger\Service
 */
class ArrayDigger
{

    /**
     * @var null|string
     */
    protected $delimiter;

    const DEFAULT_DELIMITER = '.';

    /**
     * ArrayDigger constructor.
     * @param null|string $delimiter
     */
    public function __construct($delimiter = null)
    {
        $this->setDelimiter($delimiter);
    }

    /**
     * @param array $resourceData
     * @param $path
     * @param null $delimiter
     * @return array|mixed|null
     */
    public function extractData(array $resourceData, $path, $delimiter = null) {

        $delimiter = ($delimiter)?$delimiter:($this->getDelimiter())?$this->getDelimiter():self::DEFAULT_DELIMITER;

        $pathExploded = explode($delimiter,$path);

        $copy = null;

        if ( is_array($resourceData) && ! empty($pathExploded)) {
            $copy = $resourceData;
            foreach($pathExploded as $pathIndex) {
                if(is_array($copy) && array_key_exists($pathIndex,$copy)) {
                    $copy = $copy[$pathIndex];
                } elseif(is_object($copy) && property_exists($copy,$pathIndex)) {
                    $copy = $copy->{$pathIndex};
                } else {
                    $copy = null;
                }
            }
        }

        return $copy;

    }

    /**
     * @return null|string
     */
    public function getDelimiter()
    {
        return ($this->delimiter)?$this->delimiter:self::DEFAULT_DELIMITER;
    }

    /**
     * @param null|string $delimiter
     * @return $this
     */
    public function setDelimiter($delimiter=null)
    {
        $this->delimiter = ($delimiter)?$delimiter:self::DEFAULT_DELIMITER;

        return $this;
    }

}