<?php

namespace App\Http\DataFactories;

use App\Enums\DownloadStatusEnum;
use App\Http\DataTransferObjects\DownloadData;
use App\Http\Requests\DownloadCreateRequest;

class DownloadDataFactory
{
    /**
     * @param DownloadCreateRequest $request
     * @return DownloadData
     */
    public static function fromCreateRequest(DownloadCreateRequest $request): DownloadData
    {
        return new DownloadData(
            id: null,
            filename: self::getFileNameFromUrl($request->get('url')),
            format: self::getFormatFromUrl($request->get('url')),
            url: $request->get('url'),
            status: DownloadStatusEnum::Pending->value,
            createdAt: null,
            updatedAt: null
        );
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
