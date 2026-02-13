<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import type Post from '@/interfaces/PostInterface';
import PostLayout from '@/layouts/PostLayout.vue';

defineProps<{
    post: Post
}>()

defineOptions({
    layout: PostLayout
})

</script>

<template>
    <Head title="Detalhes Post " />
    <h1>Show post</h1>
    <div>
        <h2>Id: {{ post.id }}</h2>
        <h2>Title: {{ post.title }}</h2>
        <h2>Description: {{ post.description }}</h2>
    </div>
</template>
