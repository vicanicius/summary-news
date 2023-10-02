<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopHeadlines extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'country',
        'sourceId',
        'sourceName',
        'author',
        'title',
        'description',
        'url',
        'urlToImage',
        'publishedAt',
        'content',
    ];
}
