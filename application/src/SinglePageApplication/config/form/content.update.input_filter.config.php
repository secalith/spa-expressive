<?php
return array (
    'input_filter' => array(
        'uid' => array(
            'name' => 'uid',
            'required' => true,
            'validators' => array(
                array(
                    'name' => 'not_empty',
                ),
                array(
                    'name' => 'string_length',
                    'options' => array(
                        'label' => 'UID',
                    ),
                    'attributes' => array(
                        'type' => 'text',
                    ),
                ),
            ),
        ),
        'content' => array(
            'name' => 'content',
            'required' => true,
            'validators' => array(
                array(
                    'name' => 'not_empty',
                ),
                array(
                    'name' => 'string_length',
                    'options' => array(
                        'label' => 'UID',
                    ),
                    'attributes' => array(
                        'type' => 'text',
                    ),
                ),
            ),
        ),
    ),
);