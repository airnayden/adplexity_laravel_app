<?php

namespace App\Actions;

use App\Enums\DownloadStatusEnum;
use App\Exceptions\Errors\StateConflictException;
use App\Models\Download;
use App\Models\Download as DownloadModel;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DoDownload
{
    /**
     * @param int $id
     * @return StreamedResponse
     * @throws StateConflictException
     */
    public static function execute(int $id): StreamedResponse
    {
        $downloadObject = DownloadModel::findOrFail($id);

        if ($downloadObject->status != DownloadStatusEnum::Complete) {
            throw new StateConflictException(trans('adplexity.error_download_not_complete'));
        }

        return Storage::disk('adplexity')->download($downloadObject->internal_filename, $downloadObject->filename);
    }
}
