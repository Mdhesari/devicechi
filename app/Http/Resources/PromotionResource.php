<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PromotionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return array_merge(parent::toArray($request), [
            'activate_at' => $this->evaluateActivateAfter($this->activate_after, $this->activate_after_type),
            'free' => $this->price <= 0,
        ]);
    }

    private function evaluateActivateAfter($number, $type)
    {
        if (is_null($number) || $number == 0) {
            return false;
        }

        $result = 0;
        $now = now();

        switch ($type) {
            case 'month':
                $result = $now->addMonths($number);
                break;
            case 'minute':
                $result = $now->addMinutes($number);
                break;
            default:
                $result = $now->addDays($number);
        }

        return $result;
    }
}
