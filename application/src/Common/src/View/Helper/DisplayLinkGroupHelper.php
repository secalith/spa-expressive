<?php

declare(strict_types=1);

namespace Common\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Expressive\Router\RouteResult;

class DisplayLinkGroupHelper extends AbstractHelper
{

    private $urlHelper;
    private $currentUrlHelper;

    public function __construct($urlHelper,$currentUrlHelper)
    {
        $this->urlHelper = $urlHelper;
        $this->currentUrlHelper = $currentUrlHelper;
    }

    /**
     *
     * [
     * 'html_tag' => 'a',
     *  'text' => 'Details',
     *  'attributes' => [
     *   'class' => 'btn btn-sm btn-info ml-5',
     *   'href' => 'helper::url:restable.admin.category.read'
     *   ],
     *   ],
     *
     * @param $linkGroup
     * @return string
     */
    public function __invoke($linkGroup,$data=null)
    {
        $output = '';

        foreach($linkGroup as $link) {
            if(array_key_exists('attributes',$link)) {
                $attributes = '';
                foreach($link['attributes'] as $attributeName=>$attributeValue) {
                    if(is_string($attributeValue)) {
                        if(fnmatch('helper::*',$attributeValue)) {
                            $attributeValueHelper = substr($attributeValue,strpos($attributeValue,'::')+2);
                            $attrbibuteHelperName = strtok($attributeValueHelper,':');
                            $attrbibuteHelperArgument = substr($attributeValueHelper,strpos($attributeValueHelper,':')+1);

                            #TODO what if there is no arguments?

//                        var_dump($attrbibuteHelperArgument);

                            $attributes .= sprintf(
                                ' %1$s="%2$s"',
                                $attributeName,
                                $this->getView()->plugin($attrbibuteHelperName)($attrbibuteHelperArgument)
                            );
                        } else {
                            $attributes .= sprintf(' %1$s="%2$s"',$attributeName,$attributeValue);
                        }
                    } elseif(is_array($attributeValue)) {
                        $argss = [];
                        // fetch arguments first
                        foreach($attributeValue['arguments'] as $valArg) {
                            if(is_string($valArg)) {
                                $argss[]=$valArg;
                            } elseif(is_array($valArg)) {
                                $arrArg = [];
                                foreach($valArg as $k=>$v) {
                                    if(strpos($v,"::")>0){

                                        $vall = null;

                                        $argDataSource = strtok($v,'::');
                                        $argumentValueHelperArgument = substr($v,strpos($v,'::')+2);
                                        if($argDataSource=="data") {
                                            if(!is_null($data)) {
                                                $aData = explode('=>',$argumentValueHelperArgument);
                                                $argss[] = [$k=>$data->{$aData[1]}];
                                            }
                                        }


                                    }
                                }
                            }
                        }

                        if( ! empty($argss)) {
                            $pff = $this->getView()->plugin($attributeValue['name'])($argss[0],$argss[1]);

                            $attributes .= sprintf(
                                    ' %1$s="%2$s"',
                                    $attributeName,
                                    $pff
                                );
                        }
                    }

                }
            } else {
                $attributes = null;
            }

            $output .= sprintf('<%1$s%2$s>%3$s</%1$s>',$link['html_tag'],$attributes,$link['text']);
        }

        return $output;
    }
}
