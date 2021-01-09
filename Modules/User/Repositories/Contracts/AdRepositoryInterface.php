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
    public function find($id);

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

    /**
     * Get all status from ad entitiy
     *
     * @return array
     */
    public function getAllStatus(): array;

    /**
     * Get using where $data
     *
     * @param  mixed $data
     * @return void
     */
    public function get(array $data = []);

    /**
     * Set ad status as pending
     *
     * @param  int|\App\Models\Ad $ad
     * @return mixed
     */
    public function publish($ad);

    /**
     * Set ad status as pending
     *
     * @param  int|\App\Models\Ad $ad
     * @return mixed
     */
    public function delete($ad);

    /**
     * Set ad status as pending
     *
     * @param  int|\App\Models\Ad $ad
     * @return mixed
     */
    public function archive($ad);
}
