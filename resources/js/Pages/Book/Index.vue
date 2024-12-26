<template>
    <h1 class="text-2xl text-center p-1">Our Books</h1>

    <BookGeneralInfo v-for="book in books.data" :key="book.id" :book="book" />

    <div v-if="books.data.length">
        <Pagination :links="books.links" />
    </div>
</template>

<script setup>
import BookGeneralInfo from '@/Components/BookGeneralInfo.vue';
import Pagination from '@/Components/UI/Pagination.vue';

defineProps({
    books: Object
})
</script>
