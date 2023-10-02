<?php

namespace App\Repositories;

use App\Models\News;
use App\Repositories\Contracts\NewsRepositoryContract;

class NewsRepositoryEloquent extends BaseRepositoryEloquent implements NewsRepositoryContract
{
    /**
     * @var Cart
     */
    protected $model = News::class;
}
