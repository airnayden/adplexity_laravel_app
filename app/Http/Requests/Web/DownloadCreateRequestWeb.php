<?php

namespace App\Http\Requests\Web;

use App\Http\Requests\Abstracts\DownloadCreateRequestBase;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Redirect;

class DownloadCreateRequestWeb extends DownloadCreateRequestBase
{
    /**
     * @param Validator $validator
     * @return void
     */
    public function withValidator(Validator $validator): void
    {
        if ($validator->fails()) {
            Redirect::back()
                ->withErrors($validator->getMessageBag()->getMessages())
                ->withInput();
        }
    }
}
