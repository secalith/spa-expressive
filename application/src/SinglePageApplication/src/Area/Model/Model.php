<?php
namespace SinglePageApplication\Area\Model;

use SinglePageApplication\Common\Model\CommonModel as CommonModel;

class Model extends CommonModel
{
    public $scope;
    public $machine_name;
    public $block;

    /**
     * @param $property
     * @return mixed
     */
    public function get($property)
    {
        if(property_exists($this,$property)) {
            return $this->{$property};
        }
        return null;
    }

    /**
     * @return mixed
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * @param mixed $scope
     * @return string
     */
    public function setScope($scope)
    {
        $this->scope = $scope;
        return $this;
    }

    /**
     * @return string
     */
    public function getMachineName()
    {
        return $this->machine_name;
    }

    /**
     * @param string $machine_name
     * @return Model
     */
    public function setMachineName($machine_name)
    {
        $this->machine_name = $machine_name;
        return $this;
    }

    /**
     * @return null|\SinglePageApplication\Block\Model\BlockModel
     */
    public function getBlock()
    {
        return $this->block;
    }

    /**
     * @param \SinglePageApplication\Block\Model\BlockModel $block
     * @return Model
     */
    public function setBlock($block)
    {
        $this->block = $block;
        return $this;
    }

    public function exchangeArray($data)
    {
        $this->uid = (!empty($data['uid'])) ? $data['uid'] : null;
        $this->scope = (!empty($data['scope'])) ? $data['scope'] : null;
        $this->template = (!empty($data['template'])) ? $data['template'] : null;
        $this->machine_name = (!empty($data['machine_name'])) ? $data['machine_name'] : null;
        $this->block = (!empty($data['block'])) ? $data['block'] : null;
        $this->attributes = (!empty($data['attributes'])) ? $data['attributes'] : null;
        $this->setAttributes($this->getAttributes());
        $this->parameters = (!empty($data['parameters'])) ? $data['parameters'] : null;
        $this->setParameters($this->getParameters());
    }
}