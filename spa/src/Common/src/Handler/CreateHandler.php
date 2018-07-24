<?php

declare(strict_types=1);

namespace Common\Handler;

use Common\Handler\ApplicationConfigAwareInterface;
use Common\Handler\ApplicationConfigAwareTrait;
use Common\Handler\ApplicationFormAwareInterface;
use Common\Handler\ApplicationFormAwareTrait;
use Common\Handler\DataAwareInterface;
use Common\Handler\DataAwareTrait;
use Common\Handler\ApplicationFieldsetSaveServiceAwareInterface;
use Common\Handler\ApplicationFieldsetSaveServiceAwareTrait;
use Common\Delegator\RouteResourceAwareInterface;
use Common\Delegator\RouteResourceAwareTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Helper\UrlHelper;
use Zend\Expressive\Router;
use Zend\Expressive\Template;

class CreateHandler implements RequestHandlerInterface,
    DataAwareInterface,
    ApplicationConfigAwareInterface,
    ApplicationFormAwareInterface,
    ApplicationFieldsetSaveServiceAwareInterface,
    RouteResourceAwareInterface
{
    use ApplicationConfigAwareTrait;
    use ApplicationFieldsetSaveServiceAwareTrait;
    use ApplicationFormAwareTrait;
    use DataAwareTrait;
    use RouteResourceAwareTrait;

    private $containerName;

    private $router;

    private $template;

    private $urlHelper;

    private $routeConfig;

    public function __construct(
        Router\RouterInterface $router,
        Template\TemplateRendererInterface $template = null,
        string $containerName,
        UrlHelper $urlHelper = null,
        array $routeConfig = []
    ) {
        $this->router        = $router;
        $this->template      = $template;
        $this->containerName = $containerName;
        $this->urlHelper = $urlHelper;
        $this->routeConfig = $routeConfig;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $handlerConfig = $this->getData('handler_config');

        $this->addData($this->getForms(),'forms');
        $messages = null;
        $rowsAffected = null;
        $results = null;

        if(strtoupper($request->getMethod())==="POST") {

            $postData = $request->getParsedBody();

            $iForms=0;

            // get all pre-loaded forms
            foreach($this->getForms() as $formIdentifier=>$formItem) {
//var_dump($postData);

                // search for pre_validate
                if( array_key_exists('forms',$this->routeConfig) )
                {
                    foreach($this->routeConfig['forms'] as $routeConfigForm)
                    {
                        if($routeConfigForm['name']===$formItem->getName())
                        {
                            if(array_key_exists('pre_validate',$routeConfigForm))
                            {
                                if(array_key_exists('data',$routeConfigForm['pre_validate']))
                                {
                                    foreach($routeConfigForm['pre_validate']['data'] as $preValidateFieldset)
                                    {
                                        if(array_key_exists('change_value',$preValidateFieldset))
                                        {
                                            foreach($preValidateFieldset['change_value'] as $changePreValidateFieldset)
                                            {

                                                $sourceType = $changePreValidateFieldset['source']['type'];

                                                $newValue = $postData[$formItem->getName()][$changePreValidateFieldset['source']['source_name']][$changePreValidateFieldset['source']['source_field_name']];
                                                $postData[$formItem->getName()][$preValidateFieldset['fieldset_name']][$changePreValidateFieldset['field_name']] = $newValue;

                                            }
                                        }

//                                        var_dump($preValidateFieldset);
                                    }
                                }
                            }

                            break;
                        }
                    }
                }
//
//                var_dump($postData);


                // bind data from POST
                $formItem->setData($postData);






                if($formItem->isValid()) {

                    var_dump($formItem->getData());
                    die();

                    $messages['info'][] = 'Form is Valid.';

                    $formData = $formItem->getData();

//                    var_dump($formData);

                    if(array_key_exists('forms',$handlerConfig)) {

                        $formsConfig = $handlerConfig['forms'];

                        $iFormConfig = 0;

                        // find the config for the current form
                        foreach($formsConfig as $formConfig) {

                            $formConfigModel = new \Common\Model\CreateHandlerFormConfigModel($formConfig);

                            if($formIdentifier===$formConfigModel->getName()) {

                                if($formConfigModel->getSave()) {

                                    foreach($formConfigModel->getSave('data') as $configIndexName => $fieldsetConfig) {
//var_dumP($fieldsetConfig);
                                        if(array_key_exists('service',$fieldsetConfig)) {

                                            foreach($fieldsetConfig['service'] as $serviceConfig) {
//var_dumP($this->getFieldsetServiceAll());
                                                if( array_key_exists('fieldset_name',$fieldsetConfig)
                                                    && $this->hasFieldsetService($fieldsetConfig['fieldset_name'])
                                                ) {

                                                    $field_change = null;

                                                    if(isset($fieldsetConfig['entity_change'])) {

                                                        foreach($fieldsetConfig['entity_change'] as $entity_change ) {

//var_dump($entity_change);
                                                            if(array_key_exists('source',$entity_change)
                                                                && is_array($results)
                                                                && array_key_exists($entity_change['source']['source_name'],$results)) {
                                                                $changeResourcesResults = $results[$entity_change['source']['source_name']];
                                                            }


                                                            if($entity_change['source']['type'] === 'result-insert') {
//                                                                // swap with value from the service (for example UUID or ID generated by DB)
                                                                if(array_key_exists($entity_change['source']['source_name'],$results)) {
                                                                    $newValue=null;

                                                                    if(is_array($changeResourcesResults)) {
                                                                        $newValue = $changeResourcesResults['item'][$entity_change['source']['source_field_name']];
                                                                    } elseif(is_object($changeResourcesResults)) {
                                                                        $newValue = $changeResourcesResults->{$entity_change['source']['source_field_name']};
                                                                    }

                                                                    // check if not to hash the value
                                                                    if(array_key_exists('adapter',$entity_change)&&null!==$newValue) {
                                                                        $adapter = new $entity_change['adapter']['service']();
                                                                        $newValue = $adapter->{$entity_change['adapter']['method']}($newValue);
                                                                    }

                                                                    $field_change[$fieldsetConfig['fieldset_name']][] = [
                                                                        'name' => $entity_change['field_name'],
                                                                        'value' => $newValue,
                                                                    ];

//                                                                    var_dump($field_change);

                                                                }
                                                            } elseif($entity_change['source']['type'] === 'result-incoming') {
//                                                                // swap with value from incoming data (f.e. different element from different fieldset)
//                                                                $entityChangeSourceName = $entity_change['source']['source_name'];
//                                                                if( array_key_exists($entityChangeSourceName,$formData)
//                                                                ) {
//                                                                    $dataSourceFieldset  = (is_array($formData))
//                                                                        ? $formData[$entityChangeSourceName]
//                                                                        : $formData->get($entityChangeSourceName);
//
//                                                                    $formData->get($fieldsetConfig['fieldset_name'])
//                                                                        ->setStatus($dataSourceFieldset->{$entity_change['source']['source_field_name']});
//                                                                    ;
//
//                                                                    #TODO Validate fieldset again
//
//                                                                } else {
////                                                                    echo sprintf('service does not exists (%s)',$entityChangeSourceName);
////                                                                    die();
//                                                                }
//
                                                            } elseif($entity_change['source']['type'] === 'result-transform') {

                                                                if(array_key_exists('adapter',$entity_change)) {
                                                                    $adapter = new $entity_change['adapter']['object']();
                                                                    $newValue = $adapter->{$entity_change['adapter']['method']}(
                                                                        $formData->{$entity_change['source']['source_name']}->{$entity_change['source']['source_field_name']}
                                                                    );
//
                                                                    $field_change[$fieldsetConfig['fieldset_name']][] = [
                                                                        'name' => $entity_change['field_name'],
                                                                        'value' => $newValue,
                                                                    ];

                                                                }

                                                            }
                                                        }
                                                    }

                                                    $fieldsetService = $this->getFieldsetService($fieldsetConfig['fieldset_name']);
//var_dump($serviceConfig);

//                                                    var_dump($field_change);
//                                                    var_dump($formData);


                                                    if( ( ! array_key_exists('is_collection',$fieldsetConfig) || $fieldsetConfig['is_collection'] === true)
                                                        && property_exists($formData,$fieldsetConfig['fieldset_name'])
                                                    ) {

                                                        $fieldsetItem = $formData->{$fieldsetConfig['fieldset_name']};

                                                        if($field_change!==null && array_key_exists($fieldsetConfig['fieldset_name'],$field_change)) {
//var_dumP($field_change);
                                                            foreach($field_change[$fieldsetConfig['fieldset_name']] as $changeFieldItem) {
                                                                $fieldsetItem->{$changeFieldItem['name']} = $changeFieldItem['value'];
                                                            }
                                                        }
//
//                                                        var_dumP($fieldsetItem);
                                                        $results_tmp = $fieldsetService->{$serviceConfig['method']}($fieldsetItem);

                                                        $resultModel = new $serviceConfig['object']($results_tmp['data']);


                                                        $results[$fieldsetConfig['fieldset_name']] = $resultModel;

                                                    } elseif( array_key_exists('is_collection',$fieldsetConfig) && $fieldsetConfig['is_collection'] === true ) {
                                                        if(property_exists($formData,$fieldsetConfig['fieldset_name'])) {
                                                            echo 8;
                                                        }
                                                        var_dump($fieldsetConfig);
                                                        var_dump($formData);
                                                        echo 9999;
                                                    }


                                                } else {
                                                    echo 'dupa';
                                                }
                                            }
                                        }
                                    }
                                }

                                break;
                            }

                            $iFormConfig++;

                        }

//                        echo 'count form_config: ' . $iFormConfig . '<br />';
//var_dump($results);
                    }

                } else {
                    $messages['error'][] = 'Form seems to be invalid.';
                    $messages['error'][] = 'Data has NOT been saved.';

//                    var_dump($formItem->getMessages());

                }
                $iForms++;
            }


//            echo 'count forms: ' . $iForms . '<br />';


//var_dump($rowsAffected);
            if($rowsAffected!=null) {
                $messages['success'][] = 'Item has been updated.';
                $messages['success'][] = var_export($rowsAffected,true);
            } else {
                $messages['info'][] = 'Data unchanged.';
                $messages['info'][] = 'Item has NOT been updated.';
            }
        }

//        var_dump($results);

        $this->addData($messages,'messages');

        $this->template->addDefaultParam(Template\TemplateRendererInterface::TEMPLATE_ALL,'bodyClass','app-action-create');

        return new HtmlResponse($this->template->render($this->getData('template'), $this->getData()));
    }
}
