<?php

namespace App\Http\Requests\Api;

use Illuminate\Http\Request;

class DownloadRequestApi extends Request
{
    /**
     * @return bool
     */
    public function wantsJson(): bool
    {
        return true;
    }
}
