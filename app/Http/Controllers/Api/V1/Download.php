<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Abstracts\DownloadBase;
use App\Http\Requests\Api\DownloadIndexRequestApi;
use App\Http\Requests\Api\DownloadRequestApi;
use App\Http\Requests\Api\DownloadCreateRequestApi;
use App\Http\Resources\DownloadResource;
use App\Models\Download as DownloadModel;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Download extends DownloadBase
{
    /**
     * @apiDefine DownloadObjectResponse
     * @apiSuccess  {integer}   data.id ID of the file
     * @apiSuccess  {string}    data.filename   Filename of the remote file
     * @apiSuccess  {string}    data.format Format of the remote file
     * @apiSuccess  {string}    data.url    URL to the remote file
     * @apiSuccess  {string=pending,downloading,complete,error}    data.status Status of the download
     * @apiSuccess  {string}    [data.error]    In case the status has been set to `error`, here we might find the reason why.
     * @apiSuccess  {string}    data.created_at Date when the download was queued.
     * @apiSuccess  {string}    data.updated_at Date when the download was last updated.
     */

    /**
     * @apiGroup Downloads
     * @apiVersion 1.0.0
     * @param DownloadIndexRequestApi $request
     * @return ResourceCollection
     *@api {get} downloads/store   01. Index Files
     * @apiDescription Returns a list of `Download` objects.
     * @apiSuccess  {object[]}           data  Array of `Download` objects
     * @apiUse DownloadObjectResponse
     *
     */
    public function index(DownloadIndexRequestApi $request): ResourceCollection
    {
        return DownloadResource::collection(DownloadModel::get());
    }

    /**
     * @apiGroup Downloads
     * @apiVersion 1.0.0
     * @api {get} downloads/store   02. Queue a new file download.
     * @apiDescription Creates a new file record, validates the format and dispatches a job for async downloading.
     * @apiParam {string}       url Valid URL to a file.
     * @apiSuccess  {object}           data  Download Object
     * @apiUse DownloadObjectResponse
     *
     * @param DownloadCreateRequestApi $request
     * @return DownloadResource
     * @throws ValidationException
     */
    public function store(DownloadCreateRequestApi $request): DownloadResource
    {
        return new DownloadResource($this->storeBase($request));
    }

    /**
     * @apiGroup Downloads
     * @apiVersion 1.0.0
     * @param DownloadRequestApi $request
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     *@api {get} downloads/:id/download   03. Download a file
     * @apiDescription Downloads a file
     * @apiParam {integer}       id Valid `Download` object ID
     *
     * @param DownloadRequestApi $request
     * @param int $id
     * @return StreamedResponse
     */
    public function download(DownloadRequestApi $request, int $id): StreamedResponse
    {
        return parent::downloadBase($request, $id);
    }
}
