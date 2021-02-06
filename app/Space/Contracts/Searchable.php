<?php

namespace App\Space\Contracts;

use App\Http\Requests\SearchRequest;

interface Searchable
{

    /**
     * search
     *
     * @param  mixed $request
     * @return void
     */
    public function search(SearchRequest $request);
}
