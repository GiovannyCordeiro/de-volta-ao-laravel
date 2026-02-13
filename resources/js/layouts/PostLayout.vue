<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import FlashMessage from '@/components/FlashMessage.vue';
import Header from '@/components/Header.vue';

defineProps<{
    title?: string;
    description?: string;
}>();
</script>

<template>
    <FlashMessage />

    <Head title="Post">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>

    <Header />
    <main>
        <slot />
    </main>
</template>
