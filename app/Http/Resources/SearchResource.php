<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SearchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->getOptionValue(),
            "text" => $this->getOptionText(),
            "selected" => method_exists($this, 'getSelected') ? $this->getSelected() : false,
        ];
    }
}
