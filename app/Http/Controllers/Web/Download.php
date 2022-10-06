<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\View\View;

class Download extends BaseController
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        // View
        return view(
            'download.index',
            [

            ]
        );
    }
}
