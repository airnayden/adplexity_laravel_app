<?php

namespace App\Enums;

enum DownloadStatusEnum:string {
    case Error = 'error';
    case Pending = 'pending';
    case Downloading = 'downloading';
    case Complete = 'complete';

    /**
     * @return array
     */
    public static function getValues(): array
    {
        $values = [];

        foreach (self::cases() as $case) {
            $values[] = $case->value;
        }

        return $values;
    }
}
