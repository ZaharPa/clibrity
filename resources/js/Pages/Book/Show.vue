<template>
    <div>
        <div class="grid grid-cols-6 mb-4">
            <div>
                <img :src="book.title_url" alt="" />
            </div>
            <div class="col-span-5 text-center flex flex-col justify-center pb-6">
                <h1 class="text-2xl mb-4 text-amber-600">{{ book.title }}</h1>
                <p class="text-xl mb-2 text-amber-700">{{ book.author }}</p>
                <p class="mb-2 text-amber-800 text-lg">
                    <span>
                        {{ book.category + ' '}}
                    </span>
                    <span>
                        {{ book.size }} pages
                    </span>
                </p>
                <p class="text-amber-900">
                    <span>
                        Published by
                        <Link :href="route('profile.show', {profile: book.publisher?.id })" class="cursor-pointer hover:text-amber-600">{{ book.publisher?.name }}</Link>
                    </span>
                    <span>
                        at {{ formatDate(book.created_at) }}
                    </span>
                </p>
            </div>
        </div>

        <div>
            <label for="status" class="">Status</label>
            <select name="status"
                id="status" class="rounded-md px-5 py-0 ml-2 border-yellow-400 focus:border-orange-600 focus:ring-0 focus:bg-orange-50"
                v-model="status" @change="updateStatus"
            >
                <option :value="null"></option>
                <option value="unread">Unread</option>
                <option value="reading">Reading</option>
                <option value="read">Read</option>
            </select>

            <label for="favorite" class="cursor-pointer">
                <span @click="updateFavorite" :class="{'text-yellow-400': favorite, 'text-gray-400': !favorite}" class="text-3xl">
                    {{ favorite ? '★' : '☆' }}
                </span>
            </label>
        </div>

        <span class="text-xl text-amber-700">Description</span>
        <p class="text-amber-950 mb-4">{{ book.description }}</p>

        <div>
            <iframe :src="book.book_url" class="w-full h-[600px] rounded-lg shadow-lg" />
            <a :href="book.book_url" target="_blank" class="block text-amber-700 hover:text-orange-600 text-center mt-2 font-medium">Open PDF</a>
        </div>

        <div class="mt-2">
            <label for="notes" class="label">Notes</label>
            <textarea id="notes" v-model="notes" @change="updateNotes" class="input">
                {{ notes }}
            </textarea>
        </div>

        <div class="mt-6">
            <TopicBox :topics="topics" />
        </div>

        <div class="mt-6">
            <form @submit.prevent="sendReview" class="border border-orange-700 bg-yellow-100 p-4 rounded-md shadow-md">
                <span class="label">Leave your review book here</span>
                <select v-model="formReview.rating" class="input">
                    <option :value="null">Rating</option>
                    <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
                </select>
                <input type="text" v-model="formReview.comment" placeholder="Text comment here" class="input mt-2" />
                <button class="btn-light mt-2">Send</button>
            </form>
        </div>

        <div class="mt-6 border border-dashed border-amber-700 p-4 rounded-md shadow-lg text-amber-800">
            <span class="text-xl">Reviews</span>
            <div v-if="reviews.data.length">
                <div v-for="review in reviews.data" :key="review.id" class="mt-4 border-b border-amber-700 shadow-md">
                    <p class="text-lg text-orange-700">{{ review.user?.name }}</p>
                    <div>
                        <span v-for="i in 5" :key="i">
                            {{ i <= Math.round(review.rating) ? '★' : '☆' }}
                        </span>
                    </div>
                    <p>{{ review.comment }}</p>
                </div>
                <Pagination :links="reviews.links" class="mt-4" />
            </div>
            <div v-else>
                No comment yet
            </div>
        </div>
    </div>
</template>

<script setup>
import TopicBox from '@/Components/TopicBox.vue';
import Pagination from '@/Components/UI/Pagination.vue';
import { useDataFormatter } from '@/Composables/useDataFormatter';
import { Link, useForm } from '@inertiajs/vue3';
import axios from 'axios';
import { ref } from 'vue';

const props = defineProps({
    book: Object,
    topics: Object,
    reviews: Object,
    user_notes: Object
})

const userNotes = props.user_notes || [];

const status = ref(userNotes[0]?.status || null)
const notes = ref(userNotes[0]?.notes || null)
const favorite = ref(userNotes[0]?.favorite || false)

const updateStatus = async () => {
    if (status.value == null) {
        await axios.delete(route('book.status.delete') + `?book_id=${props.book.id}` )
    } else {
        await axios.post(route('book.status'), {
            book_id: props.book.id,
            status: status.value
        });
    }
}

const updateNotes = async () => {
    await axios.post(route('book.notes'), {
        book_id: props.book.id,
        notes: notes.value
    });
}

const updateFavorite = async () => {
    favorite.value = favorite.value ? 0 : 1
    await axios.post(route('book.favorite'), {
        book_id: props.book.id,
        favorite: favorite.value
    });
}

const formReview = useForm({
    rating: null,
    comment: ''
})

const sendReview = async () => {
    const response = await axios.post(route('book.review'), {
        rating: formReview.rating,
        comment: formReview.comment,
        book_id: props.book.id
    });

    props.reviews.data.unshift(response.data.review)
}

const { formatDate } = useDataFormatter();
</script>
