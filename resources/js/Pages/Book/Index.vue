<template>
    <h1 class="text-2xl text-center mb-5">Our Books</h1>

    <Filters :filters="filters" />

    <BookTitleGeneral :sort="sort" :order="order" :filters="filters" page_route="book.index" />
    <BookGeneralInfo v-for="book in books.data" :key="book.id" :book="book" />

    <div v-if="books.data.length">
        <Pagination :links="books.links" />
    </div>
</template>

<script setup>
import BookGeneralInfo from '@/Components/BookGeneralInfo.vue';
import Pagination from '@/Components/UI/Pagination.vue';
import Filters from '@/Pages/Book/Components/Filters.vue';
import BookTitleGeneral from '@/Components/BookTitleGeneral.vue';

const props = defineProps({
    books: Object,
    sort: String,
    order: String,
    filters: Object
})
</script>
