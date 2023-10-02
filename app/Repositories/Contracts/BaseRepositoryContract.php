<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryContract
{
    /**
     * @param  array  $find
     * @param  array  $value
     * @return Model
     */
    public function updateOrCreate(array $find, array $value): Model;
}
