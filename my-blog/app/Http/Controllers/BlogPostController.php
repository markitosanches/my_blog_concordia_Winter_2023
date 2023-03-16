<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use PDF;
use Barryvdh\DomPDF\Facade as PDF;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {                   //SELECT * FROM blog_posts;
        $posts = BlogPost::all();
        return view('blog.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$categories = new Category;
        //$categories = $categories->categorySelect();

        $categories = Category::categorySelect();
       // return $categories;

        return view('blog.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // insert into blog_posts (title, body, user_id) VALUES (?,?,?);
         // SELECT * from blog_posts WHERE id = last_inserted_id
        $newPost = BlogPost::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => Auth::user()->id,
            'categories_id' =>$request->categories_id
        ]);

        //return redirect(route('blog.index'));
        return redirect(route('blog.show', $newPost->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function show(BlogPost $blogPost)
    {

        $user = User::find(Auth()->user()->id);
        if( $user->id === $blogPost->user_id){
            $user->assignRole('Editor');
        }else{
            $user->removeRole('Editor');
            $user->removeRole('Admin');
        }
        return view('blog.show', ['blogPost' => $blogPost]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogPost $blogPost)
    {
        $categories = Category::categorySelect();
        return view('blog.edit', ['blogPost'=> $blogPost, 'categories' => $categories ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogPost $blogPost)
    {
        $blogPost->update([
            'title' => $request->title,
            'body' => $request->body,
            'categories_id' =>$request->categories_id
        ]);
        //return redirect()->back();
        return redirect(route('blog.show', $blogPost->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogPost $blogPost)
    {
        $blogPost->delete();

        return redirect(route('blog.index')); 
    }

    public function query(){
        //select * from blog_posts;
        $blog = BlogPost::all();

        //select title, body from blog_posts;
        //$blog = BlogPost::select('title', 'body')->get();

        //select * from blog_posts where user_id = 1;
        //$blog = BlogPost::select()
          //              ->where('user_id', "=", 1)
            //            ->get();

        //select * from blog_posts where id = 5;
        //$blog = BlogPost::find(5);

        //$blog = BlogPost::select()
                        // ->where('id', "=", 5)
          //              ->get();
        //$blog[0];


        //SELECT * from blog_posts WHERE user_id = 1 AND title = "Title 1";
        // $blog = BlogPost::select()
        //         ->where('user_id', '=', 1)
        //         ->where('title', '=', 'Title 1')
        //         ->get();

        //SELECT * from blog_posts WHERE user_id = 1 OR title = "Title 1";
        // $blog = BlogPost::select()
        //         ->where('user_id', '=', 1)
        //         ->orwhere('title', '=', 'Title 1')
        //         ->get();

        //SELECT * from blog_posts ORDER BY title ASC;
        // $blog = BlogPost::select()
        //         ->orderBy('title', 'ASC')
        //         ->get();

       // SELECT * from blog_posts INNER JOIN users ON user_id = users.id;
        // $blog = BlogPost::select()
        //         ->join('users', 'user_id', '=', 'users.id')
        //        // ->where('user_id','>', 5)
        //        // ->orderBy('name')
        //         ->get();

        // SELECT * from blog_posts RIGHT OUTER JOIN users ON user_id = users.id;
        // $blog = BlogPost::select()
        // ->rightJoin('users', 'user_id', '=', 'users.id')
        // ->get();

        // SELECT count(*) from blog_posts;
        //$blog = BlogPost::count();

        // SELECT max(user_id) from blog_posts;
        //$blog = BlogPost::max('user_id');

        // SELECT count(*) from blog_posts WHERE user_id = 1;
        $blog = BlogPost::select()
                ->where('user_id', '=', 1)
                ->count();

        return $blog;
        
    }
     public function pdf(BlogPost $blogPost){
        $pdf = PDF::loadView('blog.show-pdf', ['blogPost' => $blogPost]);
       // return $pdf->download('blog.pdf');
        return $pdf->stream('blog.pdf');
     }
}
