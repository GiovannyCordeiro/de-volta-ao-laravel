<script setup lang="ts">
import type { InertiaForm} from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';
import type PostForm from '@/interfaces/PostForm';
import type Post from '@/interfaces/PostInterface';

const props = defineProps<{
    submit: (form: InertiaForm<PostForm>) => void
    post?: Post
}>();

const form = useForm<PostForm>({
    id: props.post?.id || null,
    title: props.post?.title || '',
    description: props.post?.description || ''
});

</script>

<template>
    <form @submit.prevent="props.submit(form)">
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
