<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
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

    <h2>UMA PARADA MUITO LOUCA MESMO</h2>
</template>
