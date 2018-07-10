<?php
namespace SinglePageApplication\Template\Model;

class TemplateModel
{
    public $uid;
    public $name;
    public $type;
    public $route;

    public function exchangeArray($data)
    {
        $this->uid     = (!empty($data['uid'])) ? $data['uid'] : null;
        $this->name = (!empty($data['name'])) ? $data['name'] : null;
        $this->type = (!empty($data['type'])) ? $data['type'] : null;
        $this->route = (!empty($data['route'])) ? $data['route'] : null;
    }
}