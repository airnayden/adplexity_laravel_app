<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class DownloadResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array|Arrayable|\JsonSerializable
    {
        $error = null;

        // When the $request variable is `null`, then we have a CLI call.
        if (!is_null($this->error)) {
            $error = is_null($request) ? Str::substr($this->error, 0, 20) . '...' : $this->error;
        }

        return [
            'id' => $this->id,
            'filename' => $this->filename,
            'format' => $this->format,
            'url' => $this->url,
            'status' => $this->status->name,
            'error' => $error,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
