<template>
    <div v-if="isApi">
        <div class="flex flex-wrap justify-center">
            <button
                v-for="(link, index) in links"
                :key="index"
                class="py-2 px-4 rounded-md"
                :class="{'bg-amber-950 text-gray-50': link.active}"
                :disabled="!link.url"
                v-html="link.label"
                @click.prevent="$emit('change', link.url)"
            />
        </div>
    </div>

    <div v-else class="flex flex-wrap justify-center">
        <Link v-for="(link, index) in links" :key="index" class="py-2 px-4 rounded-md"
            :href="link.url"
            :class="{'bg-amber-950 text-gray-50': link.active}"
            v-html="link.label"
        />
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    links: Array,
    isApi:{
        type: Boolean,
        defalut: false
    }
})
</script>
