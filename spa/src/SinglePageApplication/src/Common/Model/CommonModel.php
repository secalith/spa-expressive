<?php
namespace SinglePageApplication\Common\Model;

use Zend\Json\Json as Json;

class CommonModel
{
    public $uid;
    public $template;
    public $type;
    public $attributes;
    public $parameters;
    public $options;

    /**
     * @return mixed
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * @param mixed $uid
     * @return ContentModel
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param mixed $template
     * @return ContentModel
     */
    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return ContentModel
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @return mixed
     */
    public function getAttribute($name)
    {
        if( !isset($this->attributes[$name])) {
            return null;
        }
        return $this->attributes[$name];
    }

    /**
     * @param mixed $attributes
     * @return Model
     */
    public function setAttributes($attributes)
    {
        if(null!==$attributes) {
            $attributes = Json::decode($attributes, Json::TYPE_ARRAY);
        }
        $this->attributes = $attributes;
        return $this;
    }

    public function getItemAttributesString()
    {
        if(null!==$this->getAttributes()) {
            return $this->getAttributesString($this->getAttributes());
        }
        return null;
    }

    public function getAttributesString($attributes=null)
    {
        if(null!==$attributes) {
            if( ! empty($attributes)) {
                $attributesString = "";
                foreach($attributes as $key=>$value) {
                    if(is_array($value)) {
                        $values = "";
                        foreach($value as $attrValue) {
                            $values = sprintf("%s %s",$values,$attrValue);
                        }
                        $attributesString = sprintf("%s %s=\"%s\"",
                            $attributesString,$key,$values);
                    } else {
                        $attributesString = sprintf("%s %s=\"%s\"",
                            $attributesString,$key,$value);
                    }
                }
                return $attributesString;
            }
        }
        return null;
    }

    public function getOuterAttributesString()
    {
        if(null!==$this->getAttributes()) {
            $attributes = $this->getAttributes();

            if( ! empty($attributes)) {
                $attributesString = "";
                foreach($attributes as $key=>$value) {
                    if(is_array($value)) {
                        $values = "";
                        foreach($value as $attrValue) {
                            $values = sprintf("%s %s",$values,$attrValue);
                        }
                        $attributesString = sprintf("%s %s=\"%s\"",
                            $attributesString,$key,$values);
                    } else {
                        $attributesString = sprintf("%s %s=\"%s\"",
                            $attributesString,$key,$value);
                    }
                }
                return $attributesString;
            }
        }
        return null;
    }

    public function getInnerAttributesString()
    {
        if(null!==$this->getAttributes()) {
            $attributes = $this->getAttributes();

            if( ! empty($attributes)) {
                $attributesString = "";
                foreach($attributes as $key=>$value) {
                    if(is_array($value)) {
                        $values = "";
                        foreach($value as $attrValue) {
                            $values = sprintf("%s %s",$values,$attrValue);
                        }
                        $attributesString = sprintf("%s %s=\"%s\"",
                            $attributesString,$key,$values);
                    } else {
                        $attributesString = sprintf("%s %s=\"%s\"",
                            $attributesString,$key,$value);
                    }
                }
                return $attributesString;
            }
        }
        return null;
    }

    /**
     * @return mixed
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @return mixed
     */
    public function getParameter($name)
    {
        if(isset($this->parameters[$name])) {
            return $this->parameters[$name];
        }
        return null;
    }

    /**
     * @param mixed $parameters
     * @return Model
     */
    public function setParameters($parameters)
    {
        if(null!==$parameters) {
            $parameters = Json::decode($parameters, Json::TYPE_ARRAY);
        }
        $this->parameters = $parameters;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @return mixed
     */
    public function getOption($name)
    {
        if(isset($this->options[$name])) {
            return $this->options[$name];
        }
        return null;
    }

    /**
     * @param mixed $parameters
     * @return Model
     */
    public function setOptions($options)
    {
        if(null!==$options) {
            $options = Json::decode($options, Json::TYPE_ARRAY);
        }
        $this->options = $options;
        return $this;
    }

    public function exchangeArray($data)
    {
        $this->uid     = (!empty($data['uid'])) ? $data['uid'] : null;
        $this->template = (!empty($data['template'])) ? $data['template'] : null;
        $this->type = (!empty($data['type'])) ? $data['type'] : null;
        $this->attributes = (!empty($data['attributes'])) ? $data['attributes'] : null;
        $this->setAttributes($this->getAttributes());
        $this->parameters = (!empty($data['parameters'])) ? $data['parameters'] : null;
        $this->setParameters($this->getParameters());
        $this->options = (!empty($data['options'])) ? $data['options'] : null;
        $this->setOptions($this->getOptions());
    }
}