<template>
    <form @submit.prevent="createTopic" class="flex flex-col items-center gap-4">
        <div class="w-full">
            <label for="title" class="label">Title</label>
            <input type="text" id="title" v-model="formTopic.title" class="input"/>
        </div>

        <div class="w-full">
            <label for="description" class="label">Description</label>
            <textarea id="title" v-model="formTopic.description" class="input"></textarea>
        </div>

        <button type="submit" class="btn-normal w-1/2">Create</button>
    </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

const formTopic = useForm({
    title: '',
    description: ''
})

const createTopic = () => {
    formTopic.post(route('topics.store'),{
        forceFormData: true
    })
}
</script>
