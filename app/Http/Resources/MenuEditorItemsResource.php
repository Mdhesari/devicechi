<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MenuEditorItemsResource extends JsonResource
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

        if (isset($items['children'])) {
            if (!empty($items['children'])) {
                $more_items = [
                    'children' => self::collection($items['children'])->toArray($request)
                ];
            }
        }

        $items = array_filter($items, function ($value, $key) {

            if ($key == 'parent_id') {
                if (!is_null($value)) {
                    return false;
                }
            }

            return $key != 'created_at' && $key != 'updated_at' && !is_null($value);
        }, ARRAY_FILTER_USE_BOTH);

        if (isset($items['text']) && $text = $items['text']) {
            $items['text'] = __($text);
        }

        if (isset($items['header']) && $header = $items['header']) {
            $items['header'] = __($header);
        }

        if (isset($items['parent_id'])) {
            return;
        }

        if (isset($items['route']) && $route = $items['route']) {
            $items['href'] = route($route);
        }

        return array_merge($items, $more_items);
    }
}
