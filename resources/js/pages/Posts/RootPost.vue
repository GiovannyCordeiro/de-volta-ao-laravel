<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import Header from '@/components/Header.vue';

interface Post {
    id: number
    title: string,
    description: string
}

defineProps({
    posts: Array<Post>
});

</script>

<template>
    <Head title="Post">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>

    <Header />

    <section class="w-full h-[90vh] flex flex-col items-center gap-10">
        <h2>Pagina principal dos posts depois de logado no carai a 4</h2>

        <Link :href="`/posts/${post.id}`"  v-for="post in posts" :key="post.id" class="w-[20%] h-[20%] border-2 border-gray-200 rounded-xl flex flex-col items-center justify-center">
            <p>Number id {{ post.id }}</p>
            <p>Title: {{ post.title }}</p>
            <p>Description: {{ post.description }}</p>
        </Link>

    </section>
</template>
