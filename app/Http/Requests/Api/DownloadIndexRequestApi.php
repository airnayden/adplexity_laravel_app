<?php

namespace App\Http\Requests\Api;

use Illuminate\Http\Request;

class DownloadIndexRequestApi extends Request
{
    /**
     * @return bool
     */
    public function wantsJson(): bool
    {
        return true;
    }
}
