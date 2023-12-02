<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogPostRequest;
use App\Models\BlogPost;
use App\Servicses\BlogService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    protected BlogService $blogService;

    public function __construct(BlogService $blogPostService)
    {
        $this->middleware('auth', ['only' => ['edit','store','edit','update','destroy','create']]);
        $this->blogService = $blogPostService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $blogPosts = $this->blogService->getBlogsPaginator();

        return view('BlogPosts.list')->with('blogPosts',$blogPosts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('BlogPosts.Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogPostRequest $request)
    {
        $blogPost = $this->blogService->addBlogPost($request->all(),$request->user());

        return redirect('dashboard')->with('message','Blog Post Created Successfully');
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $blogPost = $this->blogService->getBlogPost($id);
        return view('BlogPosts.show')->with('blogPost',$blogPost);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogPost $blogpost)
    {
        if($blogpost->user_id != auth()->user()->id)
        {
            return redirect('/unauthorized');
        }
        return view('BlogPosts.Edit')->with('blogPost',$blogpost);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogPostRequest $request, BlogPost $blogpost)
    {
        if(!$this->isAuthentificatedUser($blogpost))
        {
            return redirect()->back()->with('message','UnAuthorized Action');
        }
        $this->blogService->updateBlogPost($blogpost, $request->all());
        return redirect('dashboard')->with('message','Blog Post Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogPost $blogpost)
    {
        if(!$this->isAuthentificatedUser($blogpost))
        {
            return redirect()->back()->with('message','UnAuthorized Action');
        }
        $blogpost->delete();
        return redirect('dashboard')->with('message','Blog Post Deleted Successfully');
    }

    /**
     * @param BlogPost $blogpost
     * @return bool
     */
    public function isAuthentificatedUser(BlogPost $blogpost): bool
    {
        return $blogpost->user_id == auth()->user()->id;
    }


}
