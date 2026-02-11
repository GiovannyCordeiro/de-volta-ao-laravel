<script setup lang="ts">

import type { InertiaForm } from '@inertiajs/vue3';
import { Head } from '@inertiajs/vue3';
import Form from '@/components/Form.vue';
import Header from '@/components/Header.vue';
import type PostForm from '@/interfaces/PostForm';
import type Post from '@/interfaces/PostInterface';

defineProps<{
    post: Post
}>();

const editPost = (form: InertiaForm<PostForm>) => {
    form.put(`/posts/${form.id}`)
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
