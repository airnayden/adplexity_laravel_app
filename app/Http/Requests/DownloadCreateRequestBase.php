<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class DownloadCreateRequestBase extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'url' => ['required', 'string', 'url']
        ];
    }
}
