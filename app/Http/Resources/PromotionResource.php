<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PromotionResource extends JsonResource
{

    private $ad;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->ad = $request->ad) {
            return array_merge(parent::toArray($request), [
                'activate_at' => $this->evaluateActivateAfter($this->activate_after, $this->activate_after_type),
                'free' => $this->price <= 0,
                'paid' => $this->ad->isPromotionPaid($this->resource),
            ]);
        }

        return parent::toArray($request);
    }

    private function evaluateActivateAfter($number, $type)
    {
        if (is_null($number) || $number == 0) {
            return false;
        }

        $result = 0;
        $available_at = $this->ad->created_at;
        $original_created_at = clone $available_at;

        switch ($type) {
            case 'month':
                $available_at->addMonths($number);
                break;
            case 'minute':
                $available_at->addMinutes($number);
                break;
            default:
                $available_at->addDays($number);
        }

        $result = now()->greaterThan($available_at);

        if ($result) {
            return false;
        }

        return $available_at;
    }
}
