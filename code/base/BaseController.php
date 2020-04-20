<?php

namespace base;


class BaseController
{
    protected $post;

    public function __construct()
    {
        $this->post = Inquiries::post();
    }

    /**
     * @param null $params
     * @param $template
     * @return BaseView
     */
    public function render($params = null, $template)
    {
        $view = new BaseView($params, $template);
        return $view;
    }
}