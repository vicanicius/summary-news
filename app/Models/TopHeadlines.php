<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class TopHeadlines extends Model
{
    use HasFactory;
    use Searchable;

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

    public function toSearchableArray()
    {
        return [
            'country' => $this->country,
            'sourceName' => $this->sourceName,
            'title' => $this->title,
            'content' => $this->content,
        ];
    }
}
