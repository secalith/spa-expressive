<?php
return array(
    'application' => array(
        'service' => array(
            'commonDataMapSelector' => array(
                'data_map_fieldset_item' => array(
                    'singlepageapplication_content.update\basic' => "content.basic"
                ),
                'data' => array(
                    'selectors' => array(
                        'basic.uid' => array(
//                                                'service' => 'commonRouteService',
                            'map_service' => 'route',
                            'name' => 'uid',
                        ),
                    ),
                    'entity' => array(
                        'basic.uid' => array(
                            'map_controller_target' => 'form',
                            'map_controller_target_form' => 'singlepageapplication_content.update',
                            'map_controller_target_fieldset' => 'basic',
                        ),
                    ),
                ), // data
            ),
        ),
    ),
);