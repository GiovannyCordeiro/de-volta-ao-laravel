<script setup lang="ts">

import { Head } from '@inertiajs/vue3';
import Form from '@/components/Form.vue';
import Header from '@/components/Header.vue';
import type Post from '@/interfaces/PostInterface';

defineProps<{
    post: Post
}>();

const editPost = () => {
    console.log("Testing");
}

</script>

<template>
    <Head title="Post">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <Header />
    <h2>Um edit muito doido mesmo</h2>
    <Form :submit="editPost" :post="post" />
</template>
