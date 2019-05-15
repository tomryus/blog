<?php


namespace App\Http\Controllers\Web;
use \App\Model\Category;
use \App\Model\Article;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontController extends Controller
{
    public function index()
    {
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
    public function getCategory(category $category, article $article )
    {
        $categorycount = Category::withCount('article')->get();
        //return $post;
        //$category = Category::findOrFail('category');        
        if ($category !==null){
            //$posts = Article::where('id_category',$id_category)->get();
            $post = $category->article;
            if($post!==null){
                return view('category',['post'=> $post],['count'=>$categorycount]);
            }else{
                return kosong;
            }
            
            
        }

        
    }
    public function contact()
    {
        $category = Category::withCount('article')->get();
        return view('extend.contact',['parsing'=>$category]);
    }

    public function about()
    {
        $category = Category::withCount('article')->get();
        return view('extend.about',['parsing'=>$category]);
    }

}
