<?php

use App\Models\Post;
use App\Models\User;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

test('pode criar um post', function () {
    $user = User::factory()->create([
        'name' => 'Giovanny',
    ]);

    $post = Post::factory()->create([
        'user_id' => $user->id,
        'title' => 'Meu Primeiro Post',
        'description' => 'Descrição do meu post',
    ]);

    expect($post)
        ->toBeInstanceOf(Post::class)
        ->title->toBe('Meu Primeiro Post')
        ->description->toBe('Descrição do meu post');

    assertDatabaseHas('posts', [
        'title' => 'Meu Primeiro Post',
        'description' => 'Descrição do meu post',
        'user_id' => $user->id,
    ]);
});

test('Can be abble update Posts', function () {
    $user = User::factory()->create();

    $post = Post::factory()->create([
        'user_id' => $user->id,
    ]);

    $post->update([
        'title' => 'Título Atualizado',
        'description' => 'Descrição Atualizada',
    ]);

    expect($post)
        ->title->toBe('Título Atualizado')
        ->description->toBe('Descrição Atualizada');

    assertDatabaseHas('posts', [
        'id' => $post->id,
        'title' => 'Título Atualizado',
        'description' => 'Descrição Atualizada',
    ]);
});

test('Can be abble delete post', function () {
    $user = User::factory()->create();

    $post = Post::factory()->create([
        'user_id' => $user->id,
    ]);

    $postId = $post->id;
    $post->delete();

    assertDatabaseMissing('posts', ['id' => $postId]);
});

test('Associete more post only single user', function () {
    $user = User::factory()->create();

    Post::factory()->create(['user_id' => $user->id]);
    Post::factory()->create(['user_id' => $user->id]);
    Post::factory()->create(['user_id' => $user->id]);

    expect(Post::where('user_id', $user->id)->get())->toHaveCount(3);
});
