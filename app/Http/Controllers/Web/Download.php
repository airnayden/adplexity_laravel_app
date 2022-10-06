<?php

namespace App\Http\Controllers\Web;

use App\Actions\CreateDownload;
use App\DataFactories\DownloadDataFactory;
use App\Http\Requests\DownloadCreateRequestWeb;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Redirect;
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
        return view('download.index');
    }

    /**
     * @param DownloadCreateRequestWeb $request
     * @return RedirectResponse
     */
    public function store(DownloadCreateRequestWeb $request): RedirectResponse
    {
        CreateDownload::execute(DownloadDataFactory::fromCreateRequest($request));
        return Redirect::route('downloads.index_web')->with('message', trans('adplexity.text_add_success'));
    }
}
