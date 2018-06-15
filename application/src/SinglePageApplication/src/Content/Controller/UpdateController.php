<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace SinglePageApplication\Content\Controller;

use SinglePageApplication\Content\Model\ContentModel as ContentModel;
use SinglePageApplication\Common\Controller\Controller as CommonController;
use Zend\View\Model\ViewModel;

class UpdateController extends CommonController
{
    public function updateAction()
    {
        $this->layout("layout/spa/1601");

        $v = new ViewModel();

        $request = $this->getRequest();

        $contentModel = new ContentModel();
       // $this->getForm("singlepageapplication_content.update")['updateform']->bind($contentModel);

        if ($request->isPost()) {

            $contentModel->exchangeArray($request->getPost('singlepageapplication_content_update')['basic']);

            $this->getForm("singlepageapplication_content.update")['updateform']
                ->setData($request->getPost())
            ;

            if ($this->getForm("singlepageapplication_content.update")['updateform']->isValid()) {

                $formData = $this->getForm("singlepageapplication_content.update")['updateform']->getData();

                $result = $this->getService('repository-write')->saveItem($contentModel);

                if($result) {
                    // data has been saved
                    return $this->redirect()->toRoute('home');
                }
            }
        } else {
            $this->getForm("singlepageapplication_content.update")['updateform']
                ->setData(
                    array('singlepageapplication_content_update'=>array(
                        'basic'=>$this->getDataItem()->toArray()
                    ))
                );
        }

        $v->setTerminal(true);

        $v->setVariable('area',$this->getArea());
        $v->setVariable('block',$this->getBlock());
        $v->setVariable('contentt',$this->getContent());
        $v->setVariable('settings',$this->getSettings());
        $v->setVariable('forms',$this->getForm());

        return $v;
    }
}
