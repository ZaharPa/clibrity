<template>
    <h1 class="text-2xl text-center text-orange-700 font-medium mb-5">Our Books</h1>

    <Filters :filters="filters" />


    <div v-if="showRecommadations && recBooks.length > 0" class="mb-6">
        <h2 class="title-h2">Recommended Books</h2>
        <BookTitleGeneral  />
        <BookGeneralInfo v-for="book in recBooks" :key="book.id" :book="book" />
    </div>

    <h2 class="title-h2 pt-3">All Books</h2>
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
import { computed, onMounted, ref } from 'vue';
import axios from 'axios';

const props = defineProps({
    books: Object,
    sort: String,
    order: String,
    filters: Object
})

const recBooks = ref([]);

const fetchRecBooks = async (url = route('books.recommendations')) => {
    try {
        const response = await axios.get(url);
        recBooks.value = response.data;
        console.log(response.data)
    } catch (error) {
        console.error('Error loading recommended books: ', error);
    }
}

const showRecommadations = computed(() => {
    const hasFilters = Object.values(props.filters || {}).some(filter => filter && filter.length > 0);
    const isFirstPage = props.books.links?.find(link => link.active)?.label === '1';

    return !hasFilters && isFirstPage;
})

onMounted(() => {
    fetchRecBooks();
});
</script>
