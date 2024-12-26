<template>
    <div class="flex flex-wrap justify-center">
        <Link v-for="(link, index) in links" :key="index" class="py-2 px-4 rounded-md"
            :href="link.url" :class="{'bg-amber-950 text-gray-50': link.active}"
            v-html="link.label"
        />
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({links: Array})
</script>
