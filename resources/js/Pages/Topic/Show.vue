<template>
    <div class="mb-8">
        <div class="flex justify-between items-center text-orange-700 pr-4 mb-2">
            <span class="text-2xl font-medium">{{ topic.title }}</span>
            <span>{{ formatDate(topic.created_at) }}</span>
        </div>
        <div class="text-orange-900 text-lg">{{ topic.description }}</div>
    </div>

    <div v-for="post in posts.data" :key="post.id">
        <div class="bg-orange-100 mb-4 shadow-lg rounded-md p-2">
            <div class="flex justify-between">
                <span class="text-xl">{{ post.user.name }}</span>
                <span>{{ formatDate(post.created_at) }}</span>
            </div>
            <div class="mt-2">{{ post.content }}</div>
        </div>
    </div>

    <div v-if="posts.data.length">
        <Pagination :links="posts.links" />
    </div>
</template>

<script setup>
import Pagination from '@/Components/UI/Pagination.vue';
import { useDataFormatter } from '@/Composables/useDataFormatter';

defineProps({
    topic: Array,
    posts: Object
})

const { formatDate } = useDataFormatter()
</script>
