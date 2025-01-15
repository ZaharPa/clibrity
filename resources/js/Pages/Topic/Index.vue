<template>
    <div v-for="topic in topics.data" :key="topic.id">
        <div class="mt-2 p-2 bg-orange-100 shadow-md rounded-md hover:bg-orange-200 transition">
            <Link :href="route('topics.show', {topic: topic.id})">
                <div class="mb-2 flex justify-between pr-6">
                    <h3 class="text-xl">{{ topic.title }}</h3>
                    <span class="font-medium text-center">{{ topic.posts_count }} posts</span>
                </div>
                <div class="flex justify-between px-2 text-sm">
                    <span>by {{ topic.user.name }}</span>
                    <span>{{ formatDate(topic.created_at) }}</span>
                </div>
            </Link>
        </div>
    </div>

    <div v-if="topics.data.length" class="mt-5">
        <Pagination :links="topics.links" />
    </div>
</template>

<script setup>
import Pagination from '@/Components/UI/Pagination.vue';
import { useDataFormatter } from '@/Composables/useDataFormatter';
import { Link } from '@inertiajs/vue3';

defineProps({
    topics: Object
})

const { formatDate } = useDataFormatter()
</script>
