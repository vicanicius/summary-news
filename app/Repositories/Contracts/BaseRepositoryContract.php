<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface BaseRepositoryContract
{
    /**
     * @param  array  $find
     * @param  array  $value
     * @return Model
     */
    public function updateOrCreate(array $find, array $value): Model;

    /**
     * @param  string  $value
     * @return array
     */
    public function searchTopScore(string $value): Collection;
}
