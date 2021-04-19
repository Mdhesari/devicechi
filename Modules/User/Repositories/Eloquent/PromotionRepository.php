<?php

namespace Modules\User\Repositories\Eloquent;

use App\Models\Promotion;
use Modules\User\Repositories\Contracts\PromotionRepositoryInterface;

class PromotionRepository extends Repository implements PromotionRepositoryInterface
{
    public function __construct(Promotion $model)
    {
        $this->model = $model;
    }

    public function evaluateFinalPrice(array $promotions)
    {
        $promotions = array_filter($promotions, fn ($item, $key) => !is_null($item), ARRAY_FILTER_USE_BOTH);

        $finalPrice = $this->model->whereIn('id', $promotions)->sum('price');

        return [
            'price' => $finalPrice,
            'currency' => 'IRR',
        ];
    }
}
