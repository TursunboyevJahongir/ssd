<?php

namespace App\Http\Resources;

use App\Models\Law;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LawResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        /**
         * @var Law $this
         */
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
        ];
    }
}
