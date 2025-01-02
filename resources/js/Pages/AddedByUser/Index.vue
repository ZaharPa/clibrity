<template>
    <div v-if="books.data.length">
        <Link :href="route('added-book.create')" class="btn-normal p-2 m-2">Add new Book</Link>

        <BookTitleGeneral :sort="sort" :order="order" :control="true" page_route="added-book.index"  class="mt-4" />
        <BookGeneralInfo v-for="book in books.data" :key="book.id" :book="book" :control="true"/>

        <Pagination :links="books.links" />
    </div>
    <div v-else class="text-center">
        <div class="mb-4 font-medium text-xl text-amber-800">You don`t have any added books yet.</div>
        <Link :href="route('added-book.create')" class="btn-normal px-10 py-2">Click here for add new Book</Link>
    </div>
</template>

<script setup>
import BookGeneralInfo from '@/Components/BookGeneralInfo.vue';
import BookTitleGeneral from '@/Components/BookTitleGeneral.vue';
import Pagination from '@/Components/UI/Pagination.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    books: Object,
    sort: String,
    order: String
})
</script>
