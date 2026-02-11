<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Header from '@/components/Header.vue';

interface Post {
    id: number
    title: string,
    description: string
}

defineProps<{
    post: Post
}>()

</script>

<template>
    <Head title="Detalhes Post">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <Header />
    <h1>Show post</h1>
    <div>
        <h2>Id: {{ post.id }}</h2>
        <h2>Title: {{ post.title }}</h2>
        <h2>Description: {{ post.description }}</h2>
    </div>
</template>
