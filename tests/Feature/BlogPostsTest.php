<?php

namespace Tests\Feature;


use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BlogPostsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_can_create_a_bolg_post_for_an_authenticated_user(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/blogposts',[
            'title' => 'Rise of India',
            'content' => 'Is India’s economic rise inevitable? There’s good reason to think that this latest round of Indo-optimism might be different than previous iterations, but the country still has major challenges to address to make good on this promise. In terms of drivers, demand — in the form of a consumer boom, context appropriate innovation, and a green transition — and supply — in the form of a demographic dividend, access to finance, and major infrastructure upgrades — are helping to push the country forward. This is facilitated by policy reforms, geopolitical positioning, and a diaspora dividend. Even so, the country faces barriers to success, including unbalanced growth, unrealized demographic potential, and unrealized ease-of-business and innovation potential.'
        ]);

        $this->assertDatabaseHas('blog_posts',['title' => 'Rise of India',
            'content' => 'Is India’s economic rise inevitable? There’s good reason to think that this latest round of Indo-optimism might be different than previous iterations, but the country still has major challenges to address to make good on this promise. In terms of drivers, demand — in the form of a consumer boom, context appropriate innovation, and a green transition — and supply — in the form of a demographic dividend, access to finance, and major infrastructure upgrades — are helping to push the country forward. This is facilitated by policy reforms, geopolitical positioning, and a diaspora dividend. Even so, the country faces barriers to success, including unbalanced growth, unrealized demographic potential, and unrealized ease-of-business and innovation potential.']);
    }

    public function test_can_get_all_blog_posts(){
        $user = User::factory()->create();
        BlogPost::factory(5)->create(['user_id' => $user->id]);
        $response = $this->get('/blogposts');
        $response->assertStatus(200);
        $response->assertViewHas('blogPosts');

    }

    public function test_it_can_update_a_blog_post_successfully(){
        $user = User::factory()->create();
        $blog = BlogPost::factory()->create(['user_id' => $user->id]);
        $response = $this->actingAs($user)->put('/blogposts/'.$blog->id,['title' => 'New Title','content' => 'New Content']);
        $this->assertDatabaseHas('blog_posts',['title' => 'New Title','content' => 'New Content']);
    }

    public function test_it_can_delete_a_blog_post_succesfully(){
        $user = User::factory()->create();
        $blog = BlogPost::factory()->create(['user_id' => $user->id]);
        $response = $this->actingAs($user)->delete('/blogposts/'.$blog->id);
        $this->assertDatabaseCount('blog_posts',0);

    }

    public function test_it_cannot_delete_a_blog_post_for_un_authorized_user(){
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $blog = BlogPost::factory()->create(['user_id' => $user1->id]);
        $response = $this->actingAs($user2)->delete('/blogposts/'.$blog->id);
        $this->assertDatabaseCount('blog_posts',1);
    }

    public function test_it_cannot_update_a_blog_post_for_un_authorized_user(){
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $blog = BlogPost::factory()->create(['user_id' => $user1->id]);
        $response = $this->actingAs($user2)->put('/blogposts/'.$blog->id,['title' => 'New Title','content' => 'New Content']);
        $this->assertDatabaseHas('blog_posts',['title' => $blog->title,'content' => $blog->content]);
    }


}
