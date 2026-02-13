<script setup lang="ts">

import { Head } from '@inertiajs/vue3';
import type { InertiaForm } from '@inertiajs/vue3';
import Form from '@/components/Form.vue';
import type PostForm from '@/interfaces/PostForm';

const createPost = (form: InertiaForm<PostForm>) => {
    form.post('/posts', {
        onError: () => form.reset()
    })
}

</script>

<template>
    <Head title="Create Post" />
    <Form :submit="createPost" />
</template>
