# Single Page Application with Zend Expressive by Secalith



##### DisplayLinkGroupHelper #####
buttons index in Config

types of argument sources:
    
* `row-item`
:   mostly used in `Handler/List`, takes value from the tables row data
* `page-reource`
:   uses values from the data provided by `PageItemData` Middleware or Service
* `page-form`
:   reads the value from the form attached by Delegator(i think)
 
    
###### Link format: ######

    

    ```
    'buttons' => [
        [
            'html_tag' => 'a',
            'text' => 'Create User',
            'attributes' => [
                'class' => 'btn btn-sm btn-info ml-5',
                'href' => 'view-helper::url:spa.user.create'
            ],
        ],
    ],
    ```
    