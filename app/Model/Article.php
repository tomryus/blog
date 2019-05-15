<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use \App\Model\Category;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;
    protected $fillable =['title','slug','content','category_id','image','thumbnail','short_description'];

    
    public function Category()
    {
        return $this->belongsTo(Category::class , 'category_id', 'id');
        
    }
    public function getRouteKeyName(){
        return 'slug' ;
    }
    
}
