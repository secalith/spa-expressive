<?php

declare(strict_types=1);

namespace Common\View\Helper;

use Zend\View\Helper\AbstractHelper;

class FlashMessage extends AbstractHelper
{
    public function __invoke($messages=null,$type=null,$dismiss=false,$position=false)
    {
        $class_dismissable = "alert-dismissible fade show";
        $class_position = ($position)?"alert-position-fixed":null;
        $btn_dismiss = $this->getView()->plugin('partial')('common::flash-btn-dismiss');

        $output = null;
        if( $messages !== null ) {

            switch ($type){
                case 'error':
                    if($dismiss) {
                        $output .= "<div class='alert alert-warning ".$class_dismissable." ".$class_position."'>";
                        $output .= $btn_dismiss;
                        $output .= "<ul>";
                    } else {
                        $output .= "<ul class='alert alert-warning'>";
                    }
                    if($dismiss) {
                        $output .= $btn_dismiss;
                    }
                    foreach($messages as $message) {
                        $output .= $this->getView()->plugin('partial')('common::flash-message',['message'=>$message]);
                    }
                    $output .= "</ul>";
                    if($dismiss) {
                        $output .= "</div>";
                    }

                    break;
                case 'success':
                    if($dismiss) {
                        $output .= "<div class='alert alert-success ".$class_dismissable." ".$class_position."'>";
                        $output .= $btn_dismiss;
                        $output .= "<ul>";
                    } else {
                        $output .= "<ul class='alert alert-success'>";
                    }
                    foreach($messages as $message) {
                        $output .= $this->getView()->plugin('partial')('common::flash-message',['message'=>$message]);
                    }
                    $output .= "</ul>";
                    if($dismiss) {
                        $output .= "</div>";
                    }

                    break;
                default:
                case 'info':
                    if($dismiss) {
                        $output .= "<div class='alert alert-info ".$class_dismissable." ".$class_position."'>";
                        $output .= $btn_dismiss;
                        $output .= "<ul>";
                    } else {
                        $output .= "<ul class='alert alert-info'>";
                    }
                    foreach($messages as $message) {
                        $output .= $this->getView()->plugin('partial')('common::flash-message',['message'=>$message]);
                    }
                    $output .= "</ul>";
                    if($dismiss) {
                        $output .= "</div>";
                    }

                break;
            }

        }

        return $output;

    }
}
