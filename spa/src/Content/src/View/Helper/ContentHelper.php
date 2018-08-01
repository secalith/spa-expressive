<?php
namespace Content\View\Helper;

use Zend\View\Helper\AbstractHelper;

class ContentHelper extends AbstractHelper
{
    /**
     * @param \Common\View\Model\ViewModel $item
     * @return string
     */
    public function __invoke($item)
    {
        $output = '';

        // parse attributes with viewHelpers
        if(!empty($item->getData()->getAttributes())&&is_array($item->getData()->getAttributes())) {
            foreach($item->getData()->getAttributes() as $attrName=>$attrValue) {
                $helper = $this->get_string_between($attrValue,'[::','::]');
                if( ! $helper) {

//                    $item->getData()->setAttribute($attrName,$attrValue);
                } else {
                    $helperData = json_decode($helper);
                    foreach($helperData as $helperName=>$helperData) {
                        if(is_string($helperData)) {
                            $a = $this->getView()->plugin($helperName)($helperData);
                            $item->getData()->setAttribute($attrName,$a);
                        } else {
                            // the helpers` declaration has some variables to pass
                        }
                    }
//                    $routeNameForm = $this->get_string_between($attrName,$helper.':','::]');
//
//                    $t = $container->get(UrlHelper::class);
//                    $item->getData()->setAttribute($attrName,$attrValue);
//                    $item->setAttribute('action',$t->generate($routeNameForm));
                }

            }

        }

        $output .= $this->getView()->plugin('openTag')($item);

        if(null!==$item->getContent()) {
            foreach($item->getContent() as $childUid => $childData){
                $contentPlaceholder = sprintf("[::content:%s::]",$childData->getData()->getUid());
                $pos = strpos($item->getData()->getContent(),$contentPlaceholder);
                if($pos !== false) {
                    $renderedContent = $this->getView()->plugin('displayContent')($childData);

                    $c = str_replace($contentPlaceholder,$renderedContent,$item->getData()->getContent());
                    $item->getData()->setContent($c);
                }
            }
        }

        $helperName = $this->get_string_between($item->getData()->getContent(),'[::viewHelper:','::]');

        if($helperName) {
            $contentPlaceholder = sprintf("[::viewHelper:%s::]",$helperName);
            $renderedContent = $this->getView()->plugin($helperName)();
            $c = str_replace($contentPlaceholder,$renderedContent,$item->getData()->getContent());
            $item->getData()->setContent($c);
        }

        $helperName = $this->get_string_between($item->getData()->getType(),'[::viewHelper:','::]');
        if($helperName) {
            $contentPlaceholder = sprintf("[::viewHelper:%s::]",$helperName);
            $renderedContent = $this->getView()->plugin($helperName)($item->getData()->getContent());
            $item->getData()->setContent($renderedContent);
        }


        $output .= $item->getData()->getContent();

        $output .= $this->getView()->plugin('closeTag')($item);

        return $output;
    }

    public function get_string_between($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }
}
