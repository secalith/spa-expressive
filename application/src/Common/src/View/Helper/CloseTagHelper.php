<?php
namespace Common\View\Helper;

use Zend\View\Helper\AbstractHelper;

class CloseTagHelper extends AbstractHelper
{
    protected $tagsNotAllowed = [
        'img','i','hr','br'
    ];

    public function __invoke($item)
    {
        $parameters = json_decode($item->getData()->getParameters(),true);
        $options = json_decode($item->getData()->getOptions(),true);

        $output = '';

        if(array_key_exists('wrapper',$options)) {
            if(array_key_exists('inner',$options['wrapper'])) {
                $output .= sprintf('</%s>',$options['wrapper']['inner']['parameters']['html_tag']);
            }
        }

        if(array_key_exists('html_tag',$parameters)
            && ! in_array($parameters['html_tag'],$this->tagsNotAllowed)) {
            $output .= sprintf('</%s>',$parameters['html_tag']);
        }

        if(array_key_exists('wrapper',$options)) {
            if(array_key_exists('outer',$options['wrapper'])) {
                $output .= sprintf('</%s>',$options['wrapper']['outer']['parameters']['html_tag']);
            }
        }

        return $output;
    }
}
