<?php

namespace App\Http\Controllers\Abstracts;

use App\Actions\CreateDownload;
use App\DataFactories\DownloadDataFactory;
use App\Http\Requests\Api\DownloadCreateRequestApi;
use App\Http\Requests\Api\DownloadRequestApi;
use App\Http\Requests\Web\DownloadCreateRequestWeb;
use App\Http\Requests\Web\DownloadRequestWeb;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use App\Models\Download as DownloadModel;
use Symfony\Component\HttpFoundation\StreamedResponse;

abstract class DownloadBase extends BaseController
{
    /**
     * @param DownloadCreateRequestWeb|DownloadCreateRequestApi $request
     * @return DownloadModel
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storeBase(DownloadCreateRequestWeb|DownloadCreateRequestApi $request): DownloadModel
    {
        return CreateDownload::execute(DownloadDataFactory::fromCreateRequest($request));
    }

    /**
     * @param DownloadRequestWeb|DownloadRequestApi $request
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function downloadBase(DownloadRequestWeb|DownloadRequestApi $request, int $id): StreamedResponse
    {
        $downloadObject = DownloadModel::findOrFail($id);
        return Storage::disk('adplexity')->download($downloadObject->internal_filename, $downloadObject->filename);
    }
}
