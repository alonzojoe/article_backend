<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;
    protected $fillable = ['article_id', 'user_id'];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
