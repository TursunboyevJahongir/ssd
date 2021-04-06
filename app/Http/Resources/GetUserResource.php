<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetUserResource extends JsonResource
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
         * @var User $this
         */
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'age' => $this->age,
            'date_birth' => $this->date_birth,
            'gender' => $this->gender,
        ];
    }
}
