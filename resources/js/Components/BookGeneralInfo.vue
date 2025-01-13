<template>
    <div class="grid grid-cols-9 gap-2 mb-5 shadow-md border-b border-amber-800 text-center">
        <Link :href="route('book.show', {book: book.id})" :class="props.control ? 'col-span-8' : 'col-span-9'">
            <div
                 class="grid gap-2 hover:shadow-lg px-2 py-4 hover:font-medium hover:text-amber-950"
                :class="props.control ? 'grid-cols-8' : 'grid-cols-9'"
            >
                <span class="col-span-2 flex flex-col items-center">
                    <img :src="book.title_url" class="h-40" alt="Photo" />
                </span>
                <span class="col-span-3">{{ book.title }}</span>
                <span class="col-span-2">{{ book.author }}</span>
                <span>{{ book.category }}</span>
                <span v-if="!props.control">{{ book.size }} pages</span>
            </div>
        </Link>

        <div v-if="props.control" class="flex flex-col items-center text-center">
            <Link :href="route('added-book.edit', {added_book: book.id})" class="text-orange-600 hover:text-amber-800">
                Edit
            </Link>
            <Link
                :href="route('added-book.destroy',{added_book: book.id})"
                as="button" method="delete"
                class="text-orange-600 hover:text-amber-800 my-1"
            >
                Delete
            </Link>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    book: Object,
    control:{
        type: Boolean,
        default: false
    }
})
</script>
