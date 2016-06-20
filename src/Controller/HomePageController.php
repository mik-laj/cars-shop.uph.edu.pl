<?php

namespace Uph\Miklaj\Controller;

use Uph\Miklaj\Core\View;
use Uph\Miklaj\Core\Request;
use Uph\Miklaj\Template\TemplateEngine;

class HomePageController
{
    protected $template;

    public function __construct(TemplateEngine $template)
    {
        $this->template = $template;
    }

    public function index(Request $request)
    {
        return $this->template->render('home/home');
    }
}
