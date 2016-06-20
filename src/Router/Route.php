<?php

namespace Uph\Miklaj\Router;

use Uph\Miklaj\Core\Request;

interface Route
{
    public function match(Request $request);

    public function getView();
}
