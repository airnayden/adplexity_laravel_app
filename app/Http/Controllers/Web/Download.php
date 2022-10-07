<?php

namespace App\Http\Controllers\Web;

use App\Enums\DownloadStatusEnum;
use App\Http\Controllers\Abstracts\DownloadBase;
use App\Http\Requests\Web\DownloadIndexRequestWeb;
use App\Http\Requests\Web\DownloadCreateRequestWeb;
use App\Http\Requests\Web\DownloadRequestWeb;
use App\Http\Resources\DownloadResource;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Download as DownloadModel;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Download extends DownloadBase
{
    /**
     * @param DownloadIndexRequestWeb $request
     * @return View
     */
    public function index(DownloadIndexRequestWeb $request): View
    {
        // View
        return view('download.index', [
            'downloads' => DownloadResource::collection(DownloadModel::get()),
            'completeStatusCode' => DownloadStatusEnum::Complete
        ]);
    }

    /**
     * @param DownloadCreateRequestWeb $request
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(DownloadCreateRequestWeb $request): RedirectResponse
    {
        parent::storeBase($request);
        return Redirect::route('downloads.index_web')->with('message', trans('adplexity.text_add_success'));
    }

    /**
     * @param DownloadRequestWeb $request
     * @param int $id
     * @return StreamedResponse
     */
    public function download(DownloadRequestWeb $request, int $id): StreamedResponse
    {
        return parent::downloadBase($request, $id);
    }
}
