<?php

namespace Modules\User\Repositories\Contracts;

interface PromotionRepositoryInterface
{
    /**
     * evaluateFinalPrice
     *
     * @param  mixed $promotions
     * @return array [price, currency]
     */
    public function evaluateFinalPrice(array $promotions);
}
