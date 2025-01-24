<template>
    <form @submit.prevent="createTopic" class="flex flex-col items-center gap-4">
        <div class="w-full">
            <label for="title" class="label">Title</label>
            <input type="text" id="title" v-model="formTopic.title" class="input"/>
        </div>

        <div class="w-full">
            <label for="description" class="label">Description</label>
            <textarea id="title" v-model="formTopic.description" class="input"></textarea>
        </div>

        <div class="w-full">
            <label for="book" class="label">Book</label>
            <input
                type="text"
                id="book"
                v-model="searchBook"
                @input="fetchBooks"
                class="input"
                placeholder="Start typing to search books"
            />

            <ul v-if="filteredBooks.length" class="border border-orange-700 shadow-sm rounded-md bg-orange-200 text-amber-800">
                <li
                    v-for="book in filteredBooks"
                    :key="book.id"
                    @click="selectBook(book)"
                    class="my-1 hover:text-orange-600 cursor-pointer"
                >
                    {{ book.title }}
                </li>
            </ul>
        </div>

        <button type="submit" class="btn-normal w-1/2">Create</button>
    </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import axios from 'axios';
import { ref } from 'vue';

const formTopic = useForm({
    title: '',
    description: '',
    book_id: null
})

const searchBook = ref('');
const filteredBooks = ref([]);

const fetchBooks = async () => {
    if (searchBook.value.trim().length  < 3) {
        filteredBooks.value = [];
        return;
    }

    const response = await axios.get(route('books.search'), {
        params: { query: searchBook.value }
    });
    filteredBooks.value = response.data;
}

const selectBook = (book) => {
    formTopic.book_id = book.id;
    searchBook.value = book.title;
    filteredBooks.value = [];
}

const createTopic = () => {
    formTopic.post(route('topics.store'),{
        forceFormData: true
    })
}
</script>
