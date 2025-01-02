<template>
    <div class="grid grid-cols-9 gap-2 mb-6 px-1 border-b border-orange-500 w-full text-center text-lg font-medium">
        <span class="col-span-2" >Photo</span>
        <span class="col-span-3 cursor-pointer hover:text-xl" @click="sort('title')">
            Title
            <span v-if="props.sort === 'title'"> {{ order === 'asc' ? '↑' : '↓' }}</span>
        </span>
        <span class="col-span-2 cursor-pointer hover:text-xl" @click="sort('author')">
            Author
            <span v-if="props.sort === 'author'"> {{ order === 'asc' ? '↑' : '↓' }}</span>
        </span>
        <span class="cursor-pointer hover:text-xl" @click="sort('category')">
            Category
            <span v-if="props.sort === 'category'"> {{ order === 'asc' ? '↑' : '↓' }}</span>
        </span>
        <div v-if="props.control" style="visibility: hidden;" class="col-span-1">
            Control
        </div>
        <div v-else  class="cursor-pointer hover:text-xl" @click="sort('size')">
            Size
            <span v-if="props.sort === 'size'"> {{ order === 'asc' ? '↑' : '↓' }}</span>
        </div>
    </div>
</template>

<script setup>
import { router } from '@inertiajs/vue3';

const props = defineProps({
    sort: String,
    order: String,
    filters: Object,
    page_route: String,
    control:{
        type: Boolean,
        default: false
    }
})

function sort(column) {
    let newOrder = 'asc';
    if (column === props.sort) {
        newOrder = props.order === 'asc' ? 'desc' : 'asc';
    }

    router.get(route(props.page_route), {
        sort: column,
        order: newOrder,
        ...props.filters
    }, {
        preserveState: true,
        replace: true
    })
}
</script>
