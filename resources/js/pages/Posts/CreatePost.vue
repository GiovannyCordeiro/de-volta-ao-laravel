<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import Header from '@/components/Header.vue';
import type PostForm from '@/interfaces/PostForm';

const page = usePage();
const user = computed(() => page.props.auth.user);

const form = useForm<PostForm>({
    user_id: user.value.id,
    title: '',
    description: ''
});

const submit = () => {
    form.post('/posts', {
        onError: () => form.reset()
    })
}

</script>

<template>
    <Head title="Post">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>

    <Header />
    <h2>CREATE muito louco mesmo</h2>

    <form @submit.prevent="submit">
        <div>
            <input type="text" v-model="form.title" placeholder="Best title is here...">
            <small>{{ form.errors.title }}</small>
        </div>

        <div>
            <input type="text" v-model="form.description" placeholder="Description for all the time...">
            <small>{{ form.errors.description }}</small>
        </div>
        <button>Salvar no banco</button>
    </form>


</template>
