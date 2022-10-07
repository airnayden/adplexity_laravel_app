<?php

namespace App\DataFactories;

use App\Enums\DownloadStatusEnum;
use App\DataTransferObjects\DownloadData;
use App\Http\Requests\Api\DownloadCreateRequestApi;
use App\Http\Requests\Web\DownloadCreateRequestWeb;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class DownloadDataFactory
{
    /**
     * @param DownloadCreateRequestWeb|DownloadCreateRequestApi $request
     * @return DownloadData
     * @throws ValidationException|\HttpResponseException
     */
    public static function fromCreateRequest(DownloadCreateRequestWeb|DownloadCreateRequestApi $request): DownloadData
    {
        $downloadData = new DownloadData(
            id: null,
            filename: self::getFileNameFromUrl($request->get('url')),
            format: self::getFormatFromUrl($request->get('url')),
            url: $request->get('url'),
            status: DownloadStatusEnum::Pending->value,
            internalFilename: null,
            error: null,
            createdAt: null,
            updatedAt: null
        );

        // Validate Format
        $formats = explode(',', config('adplexity.allowed_formats'));

        if (!in_array($downloadData->format, $formats)) {
            $errors = [
                'url' => trans('adplexity.error_unsupported_format', [
                    'formats' => config('adplexity.allowed_formats')
                ])
            ];

            throw ValidationException::withMessages($errors);
        }

        return $downloadData;
    }

    /**
     * @param string $url
     * @return ?string
     */
    private static function getFileNameFromUrl(string $url): ?string
    {
        $fileData = pathinfo($url);

        return $fileData['basename'] ?? null;
    }

    /**
     * @param string $url
     * @return ?string
     */
    private static function getFormatFromUrl(string $url): ?string
    {
        $fileData = pathinfo($url);

        return $fileData['extension'] ?? null;
    }
}
