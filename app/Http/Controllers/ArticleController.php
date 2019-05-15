<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Model\Article;
use Illuminate\Validation\Rule;
use \App\Model\Category;
use Image;
use Storage;
use File;




class ArticleController extends Controller
{
    public $path;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->path = storage_path('app/public/images/article/');
        
    }

    public function index()
    {
        $article = Article::all();
        return view('article.index',['yangdikirim'=>$article]) ;
        //return $article;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = \App\Model\Category::all();
        return view ('article.create',['yangdikirim' => $category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Validator::make($request->all(),[
            'title'                 => "required|min:4",
            'image'                 => 'required|image|mimes:jpg,png,jpeg',
            'short_description'     => "required|min:2",
            'image'                 => "required",
            'content'               => "required|min:2",
            'category_id'           => "required",
        ])->validate();

        //MENGAMBIL FILE IMAGE DARI FORM
        $fileimage      = $request->file('image');
        $filethumbnail  = $request->file('image');
        
        $canvas            = Image::canvas(100, 100);
        $resizeImage       = Image::make($filethumbnail)->resize(100, 100, function($constraint) {
            $constraint->aspectRatio();
        });

        if (!File::isDirectory($this->path)) {
            //MAKA FOLDER TERSEBUT AKAN DIBUAT
            File::makeDirectory($this->path);
        }
        
        
        //MEMBUAT NAME FILE DARI GABUNGAN TIMESTAMP DAN UNIQID()
        $fileNameimage      = 'article-image'. '_' . uniqid() . '.' . $fileimage->getClientOriginalExtension();
        $fileNamethumbnail  = 'article-thumbnail'. '_' . uniqid() . '.' . $filethumbnail->getClientOriginalExtension();

        //UPLOAD ORIGINAN FILE (BELUM DIUBAH DIMENSINYA)
        Image::make($fileimage)->save($this->path . '/' . $fileNameimage);
        $canvas->insert($resizeImage, 'center');
        //SIMPAN IMAGE KE DALAM MASING-MASING FOLDER (DIMENSI)
        $canvas->save($this->path . '/' . $fileNamethumbnail);
        //Image::make($filethumbnail)->resize(100,100)->save($this->path . '/' . $fileNamethumbnail);

        
        //$image          = $request->file('image')->store('public/article/image');      
        //$thumbnailname  = $request->file('image')->store('public/article/thumbnail');

        Article::Create([
            'title'             => $request->title,
            'slug'              => str_slug($request->title),
            'image'             => $fileNameimage,
            'thumbnail'         => $fileNamethumbnail,
            'content'           => $request->content,
            'short_description' => $request->short_description,
            'category_id'       => $request->category_id,

        ]);
        return redirect()->route('article.index')->with('status', 'Artikel berhasil ditambahkan');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
            $article = Article::find($id);
            $category = \App\Model\Category::all();            
            return view('article.edit',['yangdikirim'=>$article,'item'=>$category]);
            //return $article;
        }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        \Validator::make($request->all(),[
            'title'                 => "required|min:4",
            "image"                 => "required",
            'short_description'     => "required|min:3",
            'image'                 => "required",
            'content'               => "required|min:3",
            
        ])->validate();

        $article = Article::find($id);
        //MENGAMBIL FILE IMAGE DARI FORM
        $fileimage      = $request->file('image');
        $filethumbnail  = $request->file('image');

        unlink(storage_path('app/public/images/article/'.$article->image));
        unlink(storage_path('app/public/images/article/'.$article->thumbnail));
        
            $canvas            = Image::canvas(100, 100);
            $resizeImage       = Image::make($filethumbnail)->resize(100, 100, function($constraint) {
                $constraint->aspectRatio();
            });
        //Storage::delete($article->image);
        //Storage::delete($article->thumbnail);
        //$thumbnail = $request->file('image')->store('article/thumbnail','public');
        if (!File::isDirectory($this->path)) {
            //MAKA FOLDER TERSEBUT AKAN DIBUAT
            File::makeDirectory($this->path);
        }

        //MEMBUAT NAME FILE DARI GABUNGAN TIMESTAMP DAN UNIQID()
        $fileNameimage      = 'article-image'. '_' . uniqid() . '.' . $fileimage->getClientOriginalExtension();
        $fileNamethumbnail  = 'article-thumbnail'. '_' . uniqid() . '.' . $filethumbnail->getClientOriginalExtension();

        //UPLOAD ORIGINAN FILE (BELUM DIUBAH DIMENSINYA)
        Image::make($fileimage)->save($this->path . '/' . $fileNameimage);
        $canvas->insert($resizeImage, 'center');
        //SIMPAN IMAGE KE DALAM MASING-MASING FOLDER (DIMENSI)
        $canvas->save($this->path . '/' . $fileNamethumbnail);
        //Image::make($filethumbnail)->resize(100,100)->save($this->path . '/' . $fileNamethumbnail);


        $article->update([
            'title'                 => $request->title,
            'slug'                  => str_slug($request->title),
            'image'                 => $fileNameimage,
            'thumbnail'             => $fileNamethumbnail,
            'short_description'     => $request->short_description,
            'content'               => $request->content,
            'category_id'           => $request->category_id,
        ]);
        return redirect()->route('article.index')->with('status', 'Artikel berhasil diupdate');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        //unlink(storage_path('app/public/images/article/'.$article->image));
        //unlink(storage_path('app/public/images/article/'.$article->thumbnail));
        //Storage::delete('images/article/'.$article->image);
        //Storage::delete('images/article/'.$article->thumbnail);
        $article->delete();
        return redirect()->route('article.index')->with('status', 'Artikel berhasil dihapus');
    }
    public function trash()
    {
        $article= Article::onlyTrashed()->latest()->get();
        return view('article.trash',['yangdikirim'=>$article]);
    }
    public function restore($id)
    {
        $article = Article::withTrashed()->findOrFail($id);
        if($article->trashed())
        {
            $article->restore();
            return redirect()->route('article.trash')->with('status', 'article remove from trash!')->with('status_type', 'alert');
           
            
        }else 
        {
            return redirect()->route('article.trash')->with('status', 'article is not in trash!')->with('status_type', 'alert');
        }
        
    }
    public function deletePermanent($id)
    {
        $article = Article::withTrashed()->findOrFail($id);
      
        if(!$article->trashed()){
          return redirect()->route('article.trash')->with('status', 'article is not in trash!')->with('status_type', 'alert');
        } 
        else 
        {
            //unlink(storage_path('app/public/images/article/'.$article->image));
        unlink(storage_path('app/public/images/article/'.$article->thumbnail));
            $article->forceDelete();
            return redirect()->route('article.trash')->with('status', 'article permanently deleted!');
        }
      }
}
