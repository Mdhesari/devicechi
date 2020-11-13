<?php

namespace Modules\User\Repositories\Contracts;

interface AdRepositoryInterface
{
    const STEP_CHOOSE_BRAND = 1;
    const STEP_CHOOSE_MODEL = 2;
    const STEP_CHOOSE_VARIANT = 3;
    const STEP_CHOOSE_ACCESSORY = 4;
    const STEP_CHOOSE_AGE = 5;
    const STEP_CHOOSE_PRICE = 6;
    const STEP_UPLOAD_PICTURES = 7;
    const STEP_CHOOSE_LOCATION = 8;
    const STEP_CHOOSE_CONTACT = 9;
    const STEP_FINALINFO = 10;

    /**
     * Find ad
     *
     * @param  int $id
     * @return mixed
     */
    public function find(int $id);

    /**
     * Create ad
     *
     * @param  mixed $data
     * @return mixed
     */
    public function create($data);

    /**
     * Check previous ad create steps
     *
     * @param  int $step
     * @param  mixed $user
     * @return void
     */
    public function checkPreviousSteps(int $step, $user);
}
