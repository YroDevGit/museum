<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "name"=> $this->name,
            "email" => $this->email,
            "date_add" => $this->date_add,
            "album_id" => $this->album_id,
            "id" => $this->id
        ];
    }
}
