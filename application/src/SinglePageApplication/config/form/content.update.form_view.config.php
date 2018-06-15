<?php
return array(
    'attributes' => array(
        'type' => 'form',
        'name' => 'singlepageapplication_content_update',
    ),
    'params' => array(),
    'options' => array(
        'name' => 'update',
        'html_markup_display_type' => 'default'
    ),
    'spec' => array(
        'default' => array(
            'spec' => array(
                'basic.uid' => array(
                    'attributes' => array(),
                    'params' => array(),
                    'options' => array(
                        'name' => 'basic.uid',
                    ),
                    'spec' => array(
                        'wrapper' => array(
                            'attributes' => array(
                                'class' => '',
                            ),
                            'params' => array(),
                            'options' => array(),
                        ),
                        'label' => array(
                            'wrapper' => array(
                                'attributes' => array(
                                    'class' => 'control-uid col-xs-4',
                                    'for' => 'update-basic-uid',
                                ),
                                'params' => array(),
                                'options' => array(),
                            ),
                        ),
                        'input' => array(
                            'attributes' => array(
                                'class' => 'col-xs-8',
                                'disabled' => 'disabled',
                                'id' => 'update-basic-uid',
                            ),
                            'params' => array(),
                            'options' => array(),
                            'wrapper' => array(
                                'attributes' => array(
                                    'class' => 'col-xs-11 col-xs-offset-2 col-sm-8',
                                ),
                                'params' => array(),
                                'options' => array(),
                            ),
                        ),
                        'error' => array(
                            'attributes' => array(
                                'class' => 'col-sm-offset-4 col-sm-9 app-form-wrapper-error',
                            ),
                            'params' => array(),
                            'options' => array(),
                            'wrapper' => array(),
                        ),
                        'description' => array(
                            'attributes' => array(
                                'class' => 'col-sm-offset-4 col-sm-9 app-form-wrapper-error',
                            ),
                            'params' => array(),
                            'options' => array(
                                'value' => _('This is UID'),
                                'placement' => "post",
                            ),
                            'wrapper' => array(
                                'attributes' => array(),
                                'params' => array(),
                                'options' => array(),
                            ),
                        ),
                    ), // spec
                ), // basic.uid
                'basic.name' => array(
                    'attributes' => array(),
                    'params' => array(),
                    'options' => array(
                        'name' => 'basic.name',
                    ),
                    'spec' => array(
                        'wrapper' => array(
                            'attributes' => array(
                                'class' => 'col-xs-11 col-xs-offset-2 col-sm-8',
                            ),
                            'params' => array(),
                            'options' => array(),
                        ),
                        'label' => array(
                            'wrapper' => array(
                                'attributes' => array(
                                    'class' => 'control-name col-xs-4',
                                    'for' => 'update-basic-name',
                                ),
                                'params' => array(),
                                'options' => array(),
                            ),
                        ),
                        'input' => array(
                            'attributes' => array(
                                'class' => 'col-xs-8',
                                'disabled' => 'disabled',
                                'id' => 'update-basic-name',
                            ),
                            'params' => array(),
                            'options' => array(
                                'addons' => array(
                                    array(
                                        'attributes' => array(
                                            'class' => 'input-group-addon glyphicon glyphicon-asterisk',
                                            'id' => 'input-addon-name',
                                        ),
                                        'params' => array(),
                                        'options' => array(
                                            'tag' => 'span',
                                            'type' => 'glyphicon',
                                            'position' => 'post',
                                        ),
                                    ),
                                ),
                            ),
                            'wrapper' => array(
                                'attributes' => array(
                                    'class' => 'col-xs-8',
                                ),
                                'params' => array(),
                                'options' => array(),
                            ),
                        ),
                    ), // spec
                ), // basic.name
            ),
        ),
    ),
);