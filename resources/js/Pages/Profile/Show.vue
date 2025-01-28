<template>
    <div class="flex flex-col gap-2 text-lg font-serif text-center">
        <h1 class="text-3xl text-orange-600 p-2">{{ profile.name }}</h1>
        <div class="text-orange-800">Since from {{ formatDate(profile.created_at) }}</div>
        <div class="flex justify-center gap-6 text-orange-500">
            <span>Rated {{ profile.reviews_count }} Books</span>
            <span>Published {{ profile.published_books_count }} Books</span>
            <span>Marked {{ profile.notes_count }} Books</span>
        </div>
        <div v-if="canControl" class="flex justify-around px-8 my-2 text-red-700 ">
            <Link :href="route('profile.edit', {profile: profile.id})" class="hover:text-red-500 cursor-pointer">Edit</Link>
            <Link :href="route('profile.destroy', {profile: profile.id})" as="button" method="delete" class="hover:text-red-500 cursor-pointer">Delete</Link>
        </div>
    </div>

    <div v-if="publishedBooks.data.length" class="text-center my-6">
        <div class="mb-4 text-2xl text-orange-700">{{ profile.name }}`s published books</div>
        <BookTitleGeneral   />
        <BookGeneralInfo v-for="book in publishedBooks.data" :key="book.id" :book="book" />

        <Pagination :links="publishedBooks.links" />
    </div>

    <div v-if="favBooks.data.length" class="text-center my-6">
        <div class="mb-4 text-2xl text-orange-700">{{ profile.name }}`s favorites books</div>
        <BookTitleGeneral   />
        <BookGeneralInfo v-for="book in favBooks.data" :key="book.book.id" :book="book.book" />

        <Pagination :links="favBooks.links" />
    </div>
</template>

<script setup>
import BookGeneralInfo from '@/Components/BookGeneralInfo.vue';
import BookTitleGeneral from '@/Components/BookTitleGeneral.vue';
import Pagination from '@/Components/UI/Pagination.vue';
import { useDataFormatter } from '@/Composables/useDataFormatter';
import { Link } from '@inertiajs/vue3';

defineProps({
    profile: Object,
    publishedBooks: Object,
    favBooks: Object,
    canControl: {
        type: Object,
        default: false
    }
})

const { formatDate } = useDataFormatter()
</script>
