<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\CreateDownload;
use App\DataFactories\DownloadDataFactory;
use App\Http\Requests\DownloadCreateRequestApi;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Download extends BaseController
{
    /**
     * @apiDefine DownloadObjectResponse
     * @apiSuccess  {integer}   data.id ID of the file
     */

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
     * @apiGroup Downloads
     * @apiVersion 1.0.0
     * @api {get} downloads/store   01. Queue a new file download.
     * @apiDescription Creates a new file record, validates the format and dispatches a job for async downloading.
     *
     * @apiParam {string}       url Valid URL to a file.
     *
     * @apiSuccess  {object}           data  Download Object
     * @apiUse DownloadObjectResponse
     *
     * @param DownloadCreateRequestApi $request
     * @return RedirectResponse
     */
    public function store(DownloadCreateRequestApi $request)
    {
        CreateDownload::execute(DownloadDataFactory::fromCreateRequest($request));
    }
}
