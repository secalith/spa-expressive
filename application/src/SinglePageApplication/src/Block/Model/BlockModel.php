<?php
namespace SinglePageApplication\Block\Model;

use Common\Controller\CommonController;
use SinglePageApplication\Common\Model\CommonModel as CommonModel;
use Zend\Json\Json as Json;

class BlockModel extends CommonModel
{
    public $area;
    public $content;


    /**
     * @return mixed
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * @param mixed $area
     * @return $this
     */
    public function setArea($area)
    {
        $this->area = $area;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    public function exchangeArray($data)
    {
        $this->uid     = (!empty($data['uid'])) ? $data['uid'] : null;
        $this->area     = (!empty($data['area'])) ? $data['area'] : null;
        $this->type = (!empty($data['type'])) ? $data['type'] : null;
        $this->template = (!empty($data['template'])) ? $data['template'] : null;
        $this->content = (!empty($data['content'])) ? $data['content'] : null;
        $this->attributes = (!empty($data['attributes'])) ? $data['attributes'] : null;
        $this->setAttributes($this->getAttributes());
        $this->parameters = (!empty($data['parameters'])) ? $data['parameters'] : null;
        $this->setParameters($this->getParameters());
        $this->options = (!empty($data['options'])) ? $data['options'] : null;
        $this->setOptions($this->getOptions());
    }
}