<template>
    <div class="grid grid-cols-9 gap-2 mb-4 px-2">
        <span class="col-span-2">Photo</span>
        <span class="col-span-3">{{ book.title }}</span>
        <span class="col-span-2">{{ book.author }}</span>
        <span >{{ book.genre }}</span>
        <span>{{ book.size }} pages</span>
    </div>
</template>

<script setup>
    defineProps({
        book: Object
    })
</script>
