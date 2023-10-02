<?php

namespace App\Repositories;

use App\Models\TopHeadlines;
use App\Repositories\Contracts\TopHeadlinesRepositoryContract;

class TopHeadlinesRepositoryEloquent extends BaseRepositoryEloquent implements TopHeadlinesRepositoryContract
{
    /**
     * @var Cart
     */
    protected $model = TopHeadlines::class;
}
