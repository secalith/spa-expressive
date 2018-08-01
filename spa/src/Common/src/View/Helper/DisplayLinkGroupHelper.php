<?php

declare(strict_types=1);

namespace Common\View\Helper;

use ArrayDigger\Service\ArrayDigger;
use Zend\View\Helper\AbstractHelper;
use Zend\Expressive\Router\RouteResult;

class DisplayLinkGroupHelper extends AbstractHelper
{

    private $urlHelper;
    private $currentUrlHelper;
    private $arrayDigger;

    public function __construct($urlHelper,$currentUrlHelper,$arrayDigger)
    {
        $this->urlHelper = $urlHelper;
        $this->currentUrlHelper = $currentUrlHelper;
        $this->arrayDigger = $arrayDigger;
    }

    /**
     * @param $linkGroup
     * @return string
     */
    public function __invoke(array $linkGroup,$data=null)
    {
        $output = '';

        foreach($linkGroup as $link) {
            if(array_key_exists('attributes',$link)) {
                // will be storing the (final) html attributes string
                $attributes = '';
                foreach($link['attributes'] as $attributeName=>$attributeValue) {
                    if(is_string($attributeValue)) {

                        if(fnmatch('helper::*',$attributeValue)) {
                            $attributeValueHelper = substr($attributeValue,strpos($attributeValue,'::')+2);
                            $attrbibuteHelperName = strtok($attributeValueHelper,':');
                            $attrbibuteHelperArgument = substr($attributeValueHelper,strpos($attributeValueHelper,':')+1);

                            $attributes .= sprintf(
                                ' %1$s="%2$s"',
                                $attributeName,
                                $this->getView()->plugin($attrbibuteHelperName)($attrbibuteHelperArgument)
                            );
                        } else {
                            // simply concat the attr and value
                            $attributes .= sprintf(' %1$s="%2$s"',$attributeName,$attributeValue);
                        }
                    } elseif(is_array($attributeValue)) {
                        // maybe plugin with set of arguments
                        $argss = [];
                        // fetch arguments first
                        foreach($attributeValue['arguments'] as $valArg) {
                            if(is_string($valArg)) {
                                $argss[]=$valArg;
                            } elseif(is_array($valArg)) {
                                foreach($valArg as $argName=>$argArguments)
                                {
                                    if(is_array($argArguments) && array_key_exists('source',$argArguments))
                                    {
                                        switch($argArguments['source'])
                                        {

                                            case 'row-item':
                                                if(!is_null($data)) {
                                                    $argss[] = [$argName=>$data->{$argArguments['property']}];
                                                }
                                                break;
                                            case 'data-resource':
                                                if( ! is_null($data)) {
                                                    $argss[] = [$argName=>$this->arrayDigger->extractData(
                                                        $data,
                                                        $argArguments['property_path'],
                                                        $argArguments['property_path_delimiter']
                                                    )];
                                                }
                                                break;
                                        }
                                    }
                                }
                            }
                        }

                        if( ! empty($argss)) {
                            if(count($argss)==1) {
                                $pff = $this->getView()->plugin($attributeValue['name'])($argss[0]);
                            } elseif(count($argss)==2) {
                                $pff = $this->getView()->plugin($attributeValue['name'])($argss[0],$argss[1]);
                            }


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

            $textTranslated = $this->getView()->plugin('translate')($link['text']);

            $output .= sprintf('<%1$s%2$s>%3$s</%1$s>',$link['html_tag'],$attributes,$textTranslated);
        }

        return $output;
    }
}
