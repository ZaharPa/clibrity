<template>
    <form @submit.prevent="filter">
        <div class="mb-8 flex flex-wrap gap-4">
            <div class="flex flex-nowrap items-center">
                <input v-model="filterForm.title" type="text" placeholder="Title" class="input-filter-l" />
                <input v-model="filterForm.author" type="text" placeholder="Author" class="input-filter-r" />
            </div>

            <div class="flex flex-nowrap items-center">
                <select v-model="filterForm.category" class="input-filter-l">
                    <option :value="null">Category</option>
                    <option value="Fiction">Fiction</option>
                    <option value="Non-Fiction">Non-Fiction</option>
                    <option value="Science Fiction">Science Fiction</option>
                    <option value="Fantasy">Fantasy</option>
                    <option value="Biography">Biography</option>
                    <option value="Mystery">Mystery</option>
                    <option value="Romance">Romance</option>
                    <option value="Thriller">Thriller</option>
                </select>

                <select v-model="filterForm.size" class="input-filter-r">
                    <option :value="null">Size</option>
                    <option value="1">1-100</option>
                    <option value="101">101-200</option>
                    <option value="201">201-300</option>
                    <option value="301">301-400</option>
                    <option value="401">401-500</option>
                    <option value="501">501-600</option>
                    <option value="601">600+</option>
                </select>
            </div>

            <div class="items-center space-x-3">
                <button type="submit" class="btn-normal">Filter</button>
                <button type="reset" @click="clear" class="btn-normal">Clear</button>
            </div>
        </div>
    </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    filters: Object
})

const filterForm = useForm({
    title: props.filters.title ?? null,
    author: props.filters.author ?? null,
    category: props.filters.category ?? null,
    size: props.filters.size ?? null
})

const filter = () => {
    filterForm.get(
        route('book.index'),
        {
            preserveState: true,
            preserveScroll: true,
        }
    )
}

const clear = () => {
    filterForm.title = null
    filterForm.author = null
    filterForm.category = null
    filterForm.size = null
    filter()
}
</script>
