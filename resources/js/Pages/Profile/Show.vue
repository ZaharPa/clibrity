<template>
    <div class="flex flex-col gap-2 text-lg font-serif text-center">
        <h1 class="text-3xl text-orange-600 p-2">{{ user.name }}</h1>
        <div class="text-orange-800">Since from {{ formatDate(user.created_at) }}</div>
        <div class="flex justify-center gap-6 text-orange-500">
            <span>Rated {{ user.reviews_count }} Books</span>
            <span>Published {{ user.published_books_count }} Books</span>
            <span>Marked {{ user.notes_count }} Books</span>
        </div>
        <div class="flex justify-around px-8 my-2 text-red-700 ">
            <Link class="hover:text-red-500 cursor-pointer">Edit</Link>
            <Link class="hover:text-red-500 cursor-pointer">Delete</Link>
        </div>
    </div>
</template>

<script setup>
import { useDataFormatter } from '@/Composables/useDataFormatter';
import { Link } from '@inertiajs/vue3';

defineProps({
    user: Object
})

const { formatDate } = useDataFormatter()
</script>
