<template>
    <div class="mb-8">
        <div class="flex justify-between items-center text-orange-700 pr-4 mb-2">
            <span class="text-2xl font-medium">{{ topic.title }}</span>
            <span>{{ formatDate(topic.created_at) }}</span>
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

const props = defineProps({
    topic: Object
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

 onMounted(() => {
    fetchPosts();
    listenToTopic(props.topic.id, onPostCreated);
 });



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
</script>
