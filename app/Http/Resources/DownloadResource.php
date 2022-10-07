<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;

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
        return [
            'id' => $this->id,
            'filename' => $this->filename,
            'format' => $this->format,
            'url' => $this->url,
            'status' => $this->status,
            'error' => $this->error,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
