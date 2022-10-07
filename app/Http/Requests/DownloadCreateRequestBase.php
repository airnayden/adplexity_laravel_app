<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
