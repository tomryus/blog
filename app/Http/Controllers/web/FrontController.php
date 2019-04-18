<?php


namespace App\Http\Controllers\Web;
use \App\Model\Category;
use \App\Model\Article;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontController extends Controller
{
    public function index( article $article){
        $category = Category::withCount('article')->get();
        $article = Article::paginate(2);
        $article2 = Article::latest()->limit(2)->get();
        return view('front',['parsing' =>$category, 'article' => $article,'article2' => $article2,]);

    }
    
    public function blogpost(article $article)
    {   
        $category = Category::withCount('article')->get();
        //return $category;
        return view ('blogpost',['post'=>$article,'parsing' =>$category]);
    }
    public function getCategory($id_category, article $article )
    {
        $categorycount = Category::withCount('article')->get();
        $category = Category::findOrFail($id_category);        
        if ($category !==null){
            //$posts = Article::where('id_category',$id_category)->get();
            $posts = $category->article;
            if($posts!==null){
                return view('category',['post'=> $posts],['count'=>$categorycount]);
            }else{
                return kosong;
            }
            
            
        }

        
    }

}
