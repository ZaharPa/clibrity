<template>
    <h1 class="text-2xl text-center mb-5">Our Books</h1>

    <Filters :filters="filters" />

    <div class="grid grid-cols-9 gap-2 mb-6 px-2 border-b border-orange-500 w-full text-center text-lg font-medium">
        <span class="col-span-2" >Photo</span>
        <span class="col-span-3 cursor-pointer hover:text-xl" @click="sort('title')">
            Title
            <span v-if="props.sort === 'title'"> {{ props.order === 'asc' ? '↑' : '↓' }}</span>
        </span>
        <span class="col-span-2 cursor-pointer hover:text-xl" @click="sort('author')">
            Author
            <span v-if="props.sort === 'author'"> {{ props.order === 'asc' ? '↑' : '↓' }}</span>
        </span>
        <span class="cursor-pointer hover:text-xl" @click="sort('category')">
            Category
            <span v-if="props.sort === 'category'"> {{ props.order === 'asc' ? '↑' : '↓' }}</span>
        </span>
        <span class="cursor-pointer hover:text-xl" @click="sort('size')">
            Size
            <span v-if="props.sort === 'size'"> {{ props.order === 'asc' ? '↑' : '↓' }}</span>
        </span>
    </div>
    <BookGeneralInfo v-for="book in books.data" :key="book.id" :book="book" />

    <div v-if="books.data.length">
        <Pagination :links="books.links" />
    </div>
</template>

<script setup>
import BookGeneralInfo from '@/Components/BookGeneralInfo.vue';
import Pagination from '@/Components/UI/Pagination.vue';
import { router } from '@inertiajs/vue3';
import Filters from '@/Pages/Book/Components/Filters.vue';

const props = defineProps({
    books: Object,
    sort: String,
    order: String,
    filters: Object
})

function sort(column) {
    let newOrder = 'asc';
    if (column === props.sort) {
        newOrder = props.order === 'asc' ? 'desc' : 'asc';
    }

    router.get(route('book.index'), {
        sort: column,
        order: newOrder,
        ...props.filters
    }, {
        preserveState: true,
        replace: true
    })
}
</script>
