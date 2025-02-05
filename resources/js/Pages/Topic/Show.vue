<template>
    <div class="mb-8">
        <div class="flex justify-between items-center text-orange-700 pr-4 mb-2">
            <span class="text-2xl font-medium">{{ topic.title }}</span>
            <span>{{ formatDate(topic.created_at) }}</span>
        </div>
        <div v-if="topic.book_id">
            <span class="text-lg text-amber-800">Book - {{ topic.book.title }}</span>
        </div>
        <div v-if="canDelete">
            <Link :href="route('topics.destroy', {topic: props.topic.id})" as="button" method="delete" class="btn-light bg-red-400 hover:bg-amber-50">Delete</Link>
        </div>
        <div class="text-orange-900 text-lg">{{ topic.description }}</div>
    </div>

    <div class="mb-6">
        <form @submit.prevent="submitPost">
            <textarea
                v-model="newPost"
                placeholder="Write your opinion"
                class="w-full border border-amber-700 hover:border-amber-500 focus:outline-none focus:border-amber-500 rounded p-2 mb-2"
                rows="2"
            ></textarea>
            <button type="submit"
                class="btn-light"
            >   Add post
            </button>
        </form>
    </div>

    <div v-for="post in posts.data" :key="post.id">
        <div class="bg-orange-100 mb-4 shadow-lg rounded-md p-2">
            <div class="flex justify-between">
                <span class="text-xl">{{ post.user ? post.user.name : post.author }}</span>
                <span>{{ formatDate(post.created_at) }}</span>
            </div>
            <button
                v-if="post.canDelete"
                @click="deletePost(post.id)"
                title="Delete post"
                class="p-1 text-red-400 hover:text-red-600 font-medium text-xl float-right"
            >
                &times;
            </button>
            <div class="mt-2">{{ post.content }}</div>

        </div>
    </div>

    <div v-if="links">
        <Pagination :links="links" :is-api="true" @change="fetchPosts" />
    </div>
</template>

<script setup>
import Pagination from '@/Components/UI/Pagination.vue';
import { useDataFormatter } from '@/Composables/useDataFormatter';
import axios from 'axios';
import { onMounted, ref } from 'vue';
import { listenToTopic } from '@/Services/echo.js'
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    topic: Object,
    canDelete: {
        type: Object,
        default: false
    }
});

const posts = ref([]);
const links = ref([]);

const { formatDate } = useDataFormatter();
const newPost = ref('');

const fetchPosts = async (url = route('posts.index', {topic: props.topic?.id})) => {
    try {
        const response = await axios.get(url);
        posts.value = response.data;
        links.value = response.data.links;
    } catch (error) {
        console.error('Error loading posts: ', error);
    }
};

 const onPostCreated = (newPost) => {
    posts.value.data.unshift(newPost);
 };

const submitPost = async () => {
    if (!newPost.value.trim()) {
        alert('Field cannot be empty')
        return;
    }

    const response = await axios.post(route('posts.store', {topic: props.topic.id }), {
        content: newPost.value,
    });

    newPost.value = '';
};

const deletePost = async (postId) => {
    if(!confirm('Are you sure you want to delete this post?')) return;

    try {
        await axios.delete(route('posts.destroy', {post: postId}));
    } catch (error) {
        console.error('Error deleting post: ', error);
    }
};

const onPostDeleted = (postId) => {
    posts.value.data = posts.value.data.filter(post => post.id !== postId);
};

onMounted(() => {
    fetchPosts();
    listenToTopic(props.topic.id, onPostCreated, onPostDeleted);
 });
</script>
