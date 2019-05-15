<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use \App\Model\Article;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{   
    use SoftDeletes;
    protected $fillable =['category_name', 'slug'];
    

    public function article()
    {
        return $this->HasMany(Article::class, 'category_id','id');
    }
    public function getRouteKeyName()
    {
        return 'slug' ;
    }
    
}
