<?php

use App\Models\Post;
use App\Models\User;

use function Pest\Laravel\assertDatabaseHas;

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
