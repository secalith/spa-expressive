<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Form\Model;

use Common\Model\CommonModel as CommonModel;
use Zend\Json\Json as Json;

class FormBlockModel
{
    public $uid;
    public $block_uid;
    public $form_uid;
    public $form_fqdn;
    public $form_action;

    /**
     * @return mixed
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * @param mixed $uid
     * @return FormModel
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBlockUid()
    {
        return $this->block_uid;
    }

    /**
     * @param mixed $block_uid
     * @return FormModel
     */
    public function setBlockUid($block_uid)
    {
        $this->block_uid = $block_uid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFormUid()
    {
        return $this->form_uid;
    }

    /**
     * @param mixed $form_uid
     * @return FormModel
     */
    public function setFormUid($form_uid)
    {
        $this->form_uid = $form_uid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFormFqdn()
    {
        return $this->form_fqdn;
    }

    /**
     * @param mixed $form_fqdn
     * @return FormBlockModel
     */
    public function setFormFqdn($form_fqdn)
    {
        $this->form_fqdn = $form_fqdn;
        return $this;
    }

    public function exchangeArray($data)
    {
        $this->uid     = (!empty($data['uid'])) ? $data['uid'] : null;
        $this->block_uid = (!empty($data['block_uid'])) ? $data['block_uid'] : null;
        $this->form_uid = (!empty($data['form_uid'])) ? $data['form_uid'] : null;
        $this->form_fqdn = (!empty($data['form_fqdn'])) ? $data['form_fqdn'] : null;
    }

    public function toArray()
    {
        $properties = null;
        if (null!==$this->getUid()) {
            $properties['uid'] = $this->getUid();
        }
        if (null!==$this->getBlockUid()) {
            $properties['block_uid'] = $this->getBlockUid();
        }
        if (null!==$this->getFormUid()) {
            $properties['form_uid'] = $this->getFormUid();
        }
        if (null!==$this->getFormFqdn()) {
            $properties['form_fqdn'] = $this->getFormFqdn();
        }
        return $properties;
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}
