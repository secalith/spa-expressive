<?php

declare(strict_types=1);

namespace Common\View\Helper;

use Zend\View\Helper\AbstractHelper;

class GetFormAttached extends AbstractHelper
{
    public function __invoke($forms=null, $itemId=null, $index, $render=true, $template=null)
    {
        $output = null;
        $template = ($template!==null)?$template:'common::form-attached';

        if( $itemId !== null && is_string($itemId)) {
            $itemIdentifier = sprintf("id_%s",$itemId);
            if( array_key_exists($itemIdentifier, $forms)
                && array_key_exists('form',$forms[$itemIdentifier])
                && array_key_exists($index,$forms[$itemIdentifier]['form'])
            ) {

                $form = $forms[$itemIdentifier]['form'][$index];

                $output .= $this->getView()->plugin('partial')($template,['form'=>$form]);

            }
        }

        if( array_key_exists($index, $forms)){

            $form = $forms[$index];

            if( $render !== true ) {
                return $form;
            }

            $output .= $this->getView()->plugin('partial')($template,['form'=>$form]);

        } else {
            echo '<i>Form has not been found</i>';
        }

        return $output;

    }
}
