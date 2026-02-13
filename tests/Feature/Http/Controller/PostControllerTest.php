<?php

use App\Models\Post;
use App\Models\User;
use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

test('returns posts index', function () {
    /** @var User $user */
    $user = User::factory()->createOne();

    Post::factory(3)->for($user)->create();

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
