<?php

namespace App\Servicses;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlogService
{

    public function addBlogPost(array $blogData, User $user) :BlogPost{
        $blogPost = BlogPost::create([
            'title' => $blogData['title'],
            'content' => $blogData['content'],
            'user_id' => $user->id
        ]);

        return $blogPost;
    }

    /**
     * @param BlogPost $blogpost
     * @param array $blogValues
     * @return void
     */
    public function updateBlogPost(BlogPost $blogpost, array $blogValues): void
    {
        $blogpost->update(['title' => $blogValues['title'], 'content' => $blogValues['content']]);
    }


    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getBlogsPaginator(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $blogPosts = BlogPost::with('user')->latest()->paginate(4);
        $blogPosts->getCollection()->map(function (BlogPost $blogPost) {
            $this->getAdditional($blogPost,false);

            return $blogPost;
        });
        return $blogPosts;
    }

    /**
     * @param string $id
     * @return mixed
     */
    public function getBlogPost(string $id)
    {
        $blogPost = BlogPost::where('id', $id)->with('user')->first();
        $this->getAdditional($blogPost,true);
        return $blogPost;
    }

    /**
     * @return mixed
     */
    public function getUserBlogPostWithPagination(User $user)
    {
        $blogposts = BlogPost::select('id', 'title', 'content')->where('user_id', $user->id)->latest()->paginate(5);
        return $blogposts;
    }

    /**
     * @param BlogPost $blogPost
     * @return void
     */
    function getAdditional(BlogPost $blogPost,bool $isFullContent): void
    {
        $blogPost->publishedDate = $blogPost->created_at->format('F d, Y');
        $blogPost->content = $isFullContent ? $blogPost->content : Str::limit($blogPost->content, 50);
        $blogPost->author = $blogPost->user->name;
    }
}
