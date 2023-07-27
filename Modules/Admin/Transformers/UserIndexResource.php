<?php

namespace Modules\Admin\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class UserIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     * /\ \/ <> <=!>=! .=~ <~~ |> <*> <!-- -> *** <|~~> !== and or
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'last_login' => now(),
            'location' => 'Tehran Iran',
            'id' => $this->id,
            'registered_at' => $this->created_at,
            'picture_path' => null,
        ];
    }
}
