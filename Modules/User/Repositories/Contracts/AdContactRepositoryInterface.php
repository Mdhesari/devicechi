<?php

namespace Modules\User\Repositories\Contracts;

interface AdContactRepositoryInterface
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
}
