<template>
    <h1 class="text-center pb-5 text-2xl font-medium text-amber-600">
        Your chosen books
    </h1>

    <div class="flex justify-between mb-4 px-10">
        <button @click="filter('unread')" class="btn-light">Unread</button>
        <button @click="filter('reading')" class="btn-light">Reading</button>
        <button @click="filter('read')" class="btn-light">Read</button>
    </div>

    <div class="grid grid-cols-9 gap-2 mb-6 px-1 border-b border-orange-500 w-full text-center text-lg font-medium">
        <span class="col-span-2" >Title</span>
        <span class="col-span-1" >Author</span>
        <span class="col-span-1" >Status</span>
        <span class="col-span-4" >Notes</span>
        <span class="col-span-1 cursor-pointer hover:text-xl" @click="sort()">
            Last Update
            <span> {{ order === 'asc' ? '↑' : '↓' }}</span>
        </span>

    </div>

    <div v-for="book in books.data" :key="book.id">
        <Link :href="route('book.show', {book: book.book.id})" class="grid grid-cols-9 gap-2 mb-5 shadow-md border-b border-amber-800 text-center hover:shadow-lg px-2 py-4 hover:font-medium hover:text-amber-950">
            <span class="col-span-2">{{ book.book.title }}</span>
            <span class="col-span-1">{{ book.book.author }}</span>
            <span class="col-span-1">{{ book.status }}</span>
            <span class="col-span-4">{{ book.notes }}</span>
            <span class="col-span-1">{{ formatDate(book.updated_at) }}</span>
        </Link>
    </div>
</template>

<script setup>
import { useDataFormatter } from '@/Composables/useDataFormatter';
import { Link, router } from '@inertiajs/vue3';

const props = defineProps({
    books: Object,
    order: Object
})

function sort() {
    const newOrder = props.order === 'asc' ? 'desc' : 'asc';
    router.get(route('bookshelf'), {
        order: newOrder
    }, {
        preserveState: true,
        replace: true
    })
}

function filter(status) {
    router.get(route('bookshelf'), {
        status: status
    }, {
        preserveState: true,
        replace: true
    })
}

const { formatDate } = useDataFormatter();
</script>
