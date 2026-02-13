<script setup lang="ts">
import { Head, useForm, Link } from '@inertiajs/vue3';
import type PostForm from '@/interfaces/PostForm';
import type Post from '@/interfaces/PostInterface';
import PostLayout from '@/layouts/PostLayout.vue';

const { post } = defineProps<{
    post: Post
}>()

defineOptions({
    layout: PostLayout
})

const form = useForm<PostForm>({
    id: post.id || null,
    title: post.title || '',
    description: post.description || ''
});

const submit = () => {
    form.delete(`/posts/${form.id}`, {
        onError: () => form.reset()
    });
}

</script>

<template>
    <Head title="Detalhes Post " />
    <h1>Show post</h1>
    <div>
        <h2>Id: {{ post.id }}</h2>
        <h2>Title: {{ post.title }}</h2>
        <h2>Description: {{ post.description }}</h2>
    </div>
    <div class="mt-5 flex gap-5">
        <Link :href="`/posts/${post.id}/edit`" class="p-2 bg-amber-100">Editar</Link>
        <form @submit.prevent="submit">
            <button class="p-2 bg-amber-100 cursor-pointer">Delete</button>
        </form>
    </div>
</template>
