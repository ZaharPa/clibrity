<template>
    <div class="mb-6">
        <pre>{{ props.search }}</pre>
        <form @submit.prevent="filter">
            <input type="text" v-model="filterForm.search" placeholder="Search topic by name or title book" class="input w-fuul mb-3"/>
            <div class="flex justify-between">
                <div class="flex gap-6">
                    <button type="submit" class="btn-normal">Filter</button>
                    <button type="reset" @click="clear" class="btn-normal">Clear</button>
                </div>
                <Link :href="route('topics.create')" class="btn-normal p-2">Create Topic</Link>
            </div>
        </form>
    </div>

    <TopicBox :topics="topics.data" />

    <div v-if="topics.data.length" class="mt-5">
        <Pagination :links="topics.links" />
    </div>
</template>

<script setup>
import TopicBox from '@/Components/TopicBox.vue';
import Pagination from '@/Components/UI/Pagination.vue';
import { Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    topics: Object,
    search: Object
})

const filterForm = useForm({
    search: props.search ?? null
})

const filter = () => {
    filterForm.get(
        route('topics.index'),
    {
        preserveState: true,
        preserveScroll: true
    })
}

const clear = () => {
    filterForm.search = null
    filter()
}
</script>
