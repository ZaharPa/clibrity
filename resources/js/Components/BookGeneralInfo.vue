<template>
    <Link :href="route('book.show', {book: book.id})">
        <div class="grid grid-cols-9 gap-2 mb-5 px-2 py-4 shadow-md hover:shadow-lg border-b border-amber-800 text-center hover:font-medium hover:text-amber-950">
            <span class="col-span-2">Photo</span>
            <span class="col-span-3">{{ book.title }}</span>
            <span class="col-span-2">{{ book.author }}</span>
            <span >{{ book.category }}</span>
            <span>{{ book.size }} pages</span>
        </div>
    </Link>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    book: Object
})
</script>
