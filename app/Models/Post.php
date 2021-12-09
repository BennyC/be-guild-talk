<?php

namespace App\Models;

use App\Enums\PostStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read PostStatus $status
 */
class Post extends Model
{
    use HasFactory;

    public $table = 'posts';
    protected $guarded = ['id'];
    protected $casts = [
        'status' => PostStatus::class,
    ];
}
