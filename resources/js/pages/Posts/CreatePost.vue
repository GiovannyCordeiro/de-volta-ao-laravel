<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Header from '@/components/Header.vue';

withDefaults(
    defineProps<{
        canRegister: boolean;
    }>(),
    {
        canRegister: true,
    },
);
</script>

<template>
    <Head title="Post">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>

    <Header />

    <h2>CREATE muito louco mesmo</h2>
</template>
