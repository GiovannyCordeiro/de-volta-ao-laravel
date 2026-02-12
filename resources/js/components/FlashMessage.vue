<!-- Components/FlashMessage.vue -->
<script setup lang="ts">
import { usePage } from '@inertiajs/vue3'
import { ref, watch } from 'vue'

const page = usePage()

const success = ref<string | null>(null)
const error   = ref<string | null>(null)

watch(
    () => page.props.flash as { success?: string; error?: string },
    (flash) => {
        if (flash?.success) {
            success.value = flash.success
            setTimeout(() => success.value = null, 3000)
        }

        if (flash?.error) {
            error.value = flash.error
            setTimeout(() => error.value = null, 3000)
        }
    },
    { immediate: true, deep: true } // 👈 deep: true é importante aqui
)
</script>

<template>
    <div v-if="success" class="bg-green-100 p-4">
        {{ success }}
    </div>
    <div v-if="error" class="bg-red-100 p-4">
        {{ error }}
    </div>
</template>
