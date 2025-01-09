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
            <Link :href="route('profile.edit', {profile: user.id})" class="hover:text-red-500 cursor-pointer">Edit</Link>
            <Link :href="route('profile.destroy', {profile: user.id})" as="button" method="delete" class="hover:text-red-500 cursor-pointer">Delete</Link>
        </div>
    </div>

    <div class="text-center my-6">
        <div class="mb-4 text-2xl text-orange-700">{{ user.name }}`s favorites books</div>
        <BookTitleGeneral   />
        <BookGeneralInfo v-for="book in books.data" :key="book.book.id" :book="book.book" />

        <!-- <div v-if="notes.data.length">
            <Pagination :links="books.links" />
        </div> -->
    </div>
</template>

<script setup>
import BookGeneralInfo from '@/Components/BookGeneralInfo.vue';
import BookTitleGeneral from '@/Components/BookTitleGeneral.vue';
import { useDataFormatter } from '@/Composables/useDataFormatter';
import { Link } from '@inertiajs/vue3';

defineProps({
    user: Object,
    books: Object
})

const { formatDate } = useDataFormatter()
</script>
