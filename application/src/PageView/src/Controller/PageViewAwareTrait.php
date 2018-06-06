<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace PageView\Controller;

trait PageViewAwareTrait
{

    protected $pageView;

    /**
     * @return mixed
     */
    public function getPageView()
    {
        return $this->pageView;
    }

    /**
     * @param mixed $pageView
     * @return PageViewAwareTrait
     */
    public function setPageView($pageView)
    {
        $this->pageView = $pageView;
        return $this;
    }

}
