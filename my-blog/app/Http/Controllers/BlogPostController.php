<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;

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
        return view('blog.create');
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
            'user_id' => 1
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
        //SELECT * FROM blog_posts WHERE ID = $blogPost,
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
        return view('blog.edit', ['blogPost'=> $blogPost]);
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
            'body' => $request->body
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
}
