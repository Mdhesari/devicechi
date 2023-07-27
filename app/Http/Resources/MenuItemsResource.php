<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MenuItemsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $items = parent::toArray($request);
        $more_items = [];

        // Adminlte supports submenu instead of children

        if (isset($items['children'])) {
            if (!empty($items['children'])) {
                $more_items = [
                    'submenu' => self::collection($items['children'])->toArray($request)
                ];
            }
        }

        if (isset($items['href'])) {
            $items['url'] = $items['href'];
        }

        $items = array_filter($items, function ($value, $key) {

            if ($key == 'parent_id') {
                if (!is_null($value)) {
                    return false;
                }
            }

            return $key != 'created_at' && $key != 'updated_at' && !is_null($value);
        }, ARRAY_FILTER_USE_BOTH);

        return array_merge($items, $more_items);
    }
}
