<?php

namespace App\DataFactories;

use App\Enums\DownloadStatusEnum;
use App\DataTransferObjects\DownloadData;
use App\Http\Requests\Api\DownloadCreateRequestApi;
use App\Http\Requests\Web\DownloadCreateRequestWeb;
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
        return self::createDataObjectFromUrl($request->get('url'));
    }

    /**
     * @param string $url
     * @return DownloadData
     * @throws ValidationException
     */
    public static function createDataObjectFromUrl(string $url): DownloadData
    {
        $downloadData = new DownloadData(
            id: null,
            filename: self::getFileNameFromUrl($url),
            format: self::getFormatFromUrl($url),
            url: $url,
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
