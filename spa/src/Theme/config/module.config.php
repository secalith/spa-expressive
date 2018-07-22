<?php
return array(
    'view_manager' => array(
        'template_map' => array(
            'layout/spa/1601' => __DIR__ . '/../view/theme/layout/1601/layout.phtml',
            'layout/spa/ecancer' => __DIR__ . '/../view/theme/layout/ecancer/layout.phtml',
            'layout/spa/ecancer/admin' => __DIR__ . '/../view/theme/layout/ecancer/admin.phtml',
            'ecancer/template/spa/homepage' => __DIR__ . '/../view/template/ecancer/homepage.phtml',
            'ecancer/template/spa/journal' => __DIR__ . '/../view/template/ecancer/journal.phtml',
            'ecancer/template/spa/video' => __DIR__ . '/../view/template/ecancer/video.phtml',
            'ecancer/template/spa/video_item' => __DIR__ . '/../view/template/ecancer/video_item.phtml',
            'ecancer/template/spa/news' => __DIR__ . '/../view/template/ecancer/news.phtml',
            'ecancer/template/spa/elearning' => __DIR__ . '/../view/template/ecancer/elearning.phtml',
            'ecancer/template/spa/conferences' => __DIR__ . '/../view/template/ecancer/conferences.phtml',
            'ecancer/template/spa/projects' => __DIR__ . '/../view/template/ecancer/projects.phtml',
            'admin/template/spa/page/create' => __DIR__ . '/../view/template/admin/page/create.phtml',
            'ecancer/template/spa/two_left' => __DIR__ . '/../view/template/spa/two_left.phtml',
            'ecancer/template/spa/two_right' => __DIR__ . '/../view/template/spa/two_right.phtml',
            'ecancer/template/spa/full' => __DIR__ . '/../view/template/spa/full.phtml',
            'ecancer/template/spa/three' => __DIR__ . '/../view/template/spa/three.phtml',
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'form' => 'Zend\Form\View\Helper\Form',
            'formRow' => 'Zend\Form\View\Helper\FormRow',
            'form_label' => 'Zend\Form\View\Helper\FormLabel',
            'form_element' => 'Zend\Form\View\Helper\FormElement',
            'form_element_errors' => 'Zend\Form\View\Helper\FormElementErrors',
            'formtext' => 'Zend\Form\View\Helper\FormText',
            'forminput' => 'Zend\Form\View\Helper\FormInput',
            'formselect' => 'Zend\Form\View\Helper\FormSelect',
            'formcheckbox' => 'Zend\Form\View\Helper\FormCheckbox',
            'formsubmit' => 'Zend\Form\View\Helper\FormSubmit',
            'formtextarea' => 'Zend\Form\View\Helper\FormTextarea',
        ),
    ),
);