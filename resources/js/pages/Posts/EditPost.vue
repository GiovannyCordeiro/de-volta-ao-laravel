<script setup lang="ts">

import type { InertiaForm } from '@inertiajs/vue3';
import { Head } from '@inertiajs/vue3';
import Form from '@/components/Form.vue';
import type PostForm from '@/interfaces/PostForm';
import type Post from '@/interfaces/PostInterface';

defineProps<{
    post: Post
}>();

const editPost = (form: InertiaForm<PostForm>) => {
    form.put(`/posts/${form.id}`, {
        onError: () => form.reset()
    })
}

</script>

<template>
    <Head title="Edit Post" />
    <h2>Um edit muito doido mesmo</h2>
    <Form :submit="editPost" :post="post" />
</template>
