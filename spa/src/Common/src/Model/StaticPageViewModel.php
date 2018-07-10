<?php

declare(strict_types=1);

namespace Common\Model;

class StaticPageViewModel
{
    public $layout;
    public $template;

    /**
     * CartItemModel constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        if (! empty($data)) {
            $this->exchangeArray($data);
        }
    }

    /**
     * Populates the Object with data from the provided Array
     *
     * @param array $data
     * @return OrderItemModel
     */
    public function exchangeArray(array $data = [])
    {
        $this->layout = (!empty($data['layout'])) ? $data['layout'] : null;
        $this->template = (!empty($data['template'])) ? $data['template'] : null;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if ($this->layout !== null) {
            $data['layout'] = $this->layout;
        }
        if ($this->template !== null) {
            $data['template'] = $this->template;
        }

        return $data;
    }

    /**
     * @return array
     */
    public function getArrayCopy()
    {
        return $this->toArray();
    }

    /**
     * @return mixed
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * @param mixed $layout
     * @return StaticPageViewModel
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param mixed $template
     * @return StaticPageViewModel
     */
    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }

}
