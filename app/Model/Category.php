<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use \App\Model\Article;

class Category extends Model
{   
    protected $fillable =['category_name', 'slug'];

    public function article()
    {
        return $this->HasMany(Article::class, 'category_id','id');
    }
    
    
}
