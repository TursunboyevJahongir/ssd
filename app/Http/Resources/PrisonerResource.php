<?php

namespace App\Http\Resources;

use App\Models\Prisoner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PrisonerResource extends JsonResource
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
         * @var Prisoner $this
         */
        return [
            'id' => $this->id,
            'imprisonment_regime' => $this->imprisonment_regime,
            'user' => new GetUserResource($this->user),
            'crimes' => LawResource::collection($this->laws),
            'term' => $this->term,
            'start_of_term' => $this->start_of_term->format('d/m/Y'),
            'end_of_term' => $this->end_of_term->format('d/m/Y'),
        ];
    }
}
