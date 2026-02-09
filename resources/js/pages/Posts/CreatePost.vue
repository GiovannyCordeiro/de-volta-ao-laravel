<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import Header from '@/components/Header.vue';

const page = usePage();
const user = computed(() => page.props.auth.user);

const form = useForm({
    user_id: user.value.id,
    title: null,
    description: null
});

const submit = () => {
    console.log("Formulario:", form);
    // form.post('/store')
}

</script>

<template>
    <Head title="Post">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>

    <Header />
    <h2>CREATE muito louco mesmo</h2>
    <h2>dsjlkdjslkds</h2>

    <form @submit.prevent="submit">
        <input type="text" v-model="form.title" placeholder="Best title is here...">

        <input type="text" v-model="form.description" placeholder="Description for all the time...">
        <button>Salvar no banco</button>
    </form>


</template>
