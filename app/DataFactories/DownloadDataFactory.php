<?php

namespace App\DataFactories;

use App\Enums\DownloadStatusEnum;
use App\DataTransferObjects\DownloadData;
use App\Http\Requests\DownloadCreateRequestApi;
use App\Http\Requests\DownloadCreateRequestWeb;
use Illuminate\Validation\ValidationException;

class DownloadDataFactory
{
    /**
     * @param DownloadCreateRequestWeb|DownloadCreateRequestApi $request
     * @return DownloadData
     */
    public static function fromCreateRequest(DownloadCreateRequestWeb|DownloadCreateRequestApi $request): DownloadData
    {
        $downloadData = new DownloadData(
            id: null,
            filename: self::getFileNameFromUrl($request->get('url')),
            format: self::getFormatFromUrl($request->get('url')),
            url: $request->get('url'),
            status: DownloadStatusEnum::Pending->value,
            createdAt: null,
            updatedAt: null
        );

        // Validate Format
        $formats = explode(',', config('adplexity.allowed_formats'));

        if (!in_array($downloadData->format, $formats)) {
            throw ValidationException::withMessages([
                'url' => trans('adplexity.error_unsupported_format', [
                    'formats' => config('adplexity.allowed_formats')
                ])
            ]);
        }

        return $downloadData;
    }

    /**
     * @param string $url
     * @return string
     */
    private static function getFileNameFromUrl(string $url): string
    {
        $fileData = pathinfo($url);

        return $fileData['basename'];
    }

    /**
     * @param string $url
     * @return string
     */
    private static function getFormatFromUrl(string $url): string
    {
        $fileData = pathinfo($url);

        return $fileData['extension'];
    }
}
