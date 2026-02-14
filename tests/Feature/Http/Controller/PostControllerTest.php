<?php

use App\Models\Post;
use App\Models\User;
use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\put;

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

test('can update your own post', function () {
    $user = User::factory()->create();
    $post = Post::factory()->for($user)->create();

    /** @var User $user */
    actingAs($user);

    put(route('posts.update', $post), [
        'title' => 'New Title',
        'description' => 'New description', ])
        ->assertRedirect(route('posts.index'))
        ->assertSessionHas('success', 'Post Atualizado com sucesso');

    assertDatabaseHas('posts', ['title' => 'New Title']);
});

test('cannot update your own post', function () {
    $user = User::factory()->create();
    $anotherUser = User::factory()->create();

    $post = Post::factory()->for($anotherUser)->createOne();

    /** @var User $user */
    actingAs($user);

    put(route('posts.update', $post), [
        'title' => 'Other title',
        'description' => 'Other description'])
        ->assertForbidden();
});

test('can you delete your own post', function () {
    $user = User::factory()->create();
    $post = Post::factory()->for($user)->create();

    /** @var User $user */
    actingAs($user);

    delete(route('posts.destroy', $post))
        ->assertRedirect(route('posts.index'))
        ->assertSessionHas('success', 'Post Deletado com sucesso');
});

test('cannot delete other post', function () {
    $user = User::factory()->create();
    $anotherUser = User::factory()->create();
    $post = Post::factory()->for($anotherUser)->createOne();

    /** @var User $user */
    actingAs($user);

    delete(route('posts.update', $post))
        ->assertRedirect(route('posts.index'))
        ->assertSessionHas('success', 'Post Deletado com sucesso');
});
