<?php

use App\Models\Post;
use App\Models\User;
use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

test('returns posts index', function () {

    $user = User::factory()->createOne();

    Post::factory(3)->for($user)->create();

    /** @var User $user */
    actingAs($user);

    get(route('posts.index'))
        ->assertOk()
        ->assertInertia(fn (AssertableInertia $page) => $page
            ->component('Posts/RootPost')
            ->has('posts', 3)
        );
});

test('Redirect to login page if not login user', function () {
    get(route('posts.index'))->assertRedirect(route('login'));
});

test('cannot create post with invalid data', function () {
    $user = User::factory()->create();

    /** @var User $user */
    actingAs($user);

    post(route('posts.store'), [
        'title' => '',
        'description' => '',
    ])->assertSessionHasErrors(['title', 'description']);
});

test('can view own post', function () {
    $user = User::factory()->create();
    $post = Post::factory()->for($user)->createOne();
    /** @var User $user */
    actingAs($user);

    get(route('posts.show', $post))
        ->assertOk()
        ->assertInertia(fn (AssertableInertia $page) => $page
            ->component('Posts/ShowPost')
            ->has('post', fn (AssertableInertia $prop) => $prop
                ->where('id', $post->id)
                ->where('title', $post->title)
                ->where('description', $post->description)
                ->etc()
            )
        );
});

test('cannot view post another user', function () {
    $user = User::factory()->create();
    $anotherUser = User::factory()->create();

    $post = Post::factory()->for($anotherUser)->createOne();

    /** @var User $user */
    actingAs($user);

    get(route('posts.show', $post))
        ->assertForbidden();
});
