<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

</script>

<template>
    <header class="flex gap-10 m-5">
        <Link href="/">Root</Link>
        <Link href="/posts">Index</Link>
        <Link href="/posts/create">Criar</Link>
    </header>
</template>
