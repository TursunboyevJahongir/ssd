<?php

namespace App\Http\Resources;

use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetUserAddressResource extends JsonResource
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
         * @var UserAddress $this
         */
        return [
            'id' => $this->id,
            'region_id' => $this->region_id,
            'district_id' => $this->district_id,
            'user' => new GetUserResource($this->user),
        ];
    }
}
