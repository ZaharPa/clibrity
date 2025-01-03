<template>
    <BookForm :book="book" :is-edit="true" />
</template>

<script setup>
import BookForm from './Components/BookForm.vue';

defineProps({
    book: Object
})
</script>
