<?php

namespace Modules\User\Repositories\Contracts;

interface AdRepositoryInterface
{
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
