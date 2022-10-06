<?php

namespace App\DataTransferObjects;

class DownloadData
{
    /**
     * @param int|null $id
     * @param string|null $filename
     * @param string|null $format
     * @param string|null $url
     * @param string|null $status
     * @param string|null $internalFilename
     * @param string|null $error
     * @param string|null $createdAt
     * @param string|null $updatedAt
     */
    public function __construct(
        public ?int $id,
        public ?string $filename,
        public ?string $format,
        public ?string $url,
        public ?string $status,
        public ?string $internalFilename,
        public ?string $error,
        public ?string $createdAt,
        public ?string $updatedAt
    ) {
    }
}
