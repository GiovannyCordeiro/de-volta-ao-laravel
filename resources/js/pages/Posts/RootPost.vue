<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import type Post from '@/interfaces/PostInterface';
import PostLayout from '@/layouts/PostLayout.vue';

defineProps({
    posts: Array<Post>
});

defineOptions({
    layout: PostLayout
})

</script>

<template>
    <Head title="root" />
    <section class="w-full h-[90vh] flex flex-col items-center gap-10">
        <h2>Pagina principal dos posts depois de logado no carai a 4</h2>

        <Link :href="`/posts/${post.id}`"  v-for="post in posts" :key="post.id" class="w-[20%] h-[20%] border-2 border-gray-200 rounded-xl flex flex-col items-center justify-center">
            <p>Number id {{ post.id }}</p>
            <p>Title: {{ post.title }}</p>
            <p>Description: {{ post.description }}</p>
        </Link>
    </section>
</template>
