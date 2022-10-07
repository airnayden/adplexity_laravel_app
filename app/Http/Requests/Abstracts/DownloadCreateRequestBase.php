<?php

namespace App\Http\Requests\Abstracts;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;

abstract class DownloadCreateRequestBase extends FormRequest
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
