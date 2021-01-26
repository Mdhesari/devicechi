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

    /**
     * First or Create ad
     *
     * @param  mixed $data
     * @return mixed
     */
    public function firstOrCreate($data);

    /**
     * Send verification to intended user contact
     *
     * @param  mixed $ad_contact
     * @param  mixed $code
     * @return void
     */
    public function sendVerification($ad_contact, $code);
}
