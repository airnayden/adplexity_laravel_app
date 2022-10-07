<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Abstracts\DownloadCreateRequestBase;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class DownloadCreateRequestApi extends DownloadCreateRequestBase
{
    /**
     * @return bool
     */
    public function wantsJson(): bool
    {
        return true;
    }

    /**
     * @param Validator $validator
     * @return void
     * @throws ValidationException
     */
    public function withValidator(Validator $validator): void
    {
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
