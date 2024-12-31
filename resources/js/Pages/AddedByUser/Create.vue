<template>
    <form @submit.prevent="create">
        <div class="w-2/3 mx-auto">
            <div class="mb-4">
                <label for="title" class="label">Title</label>
                <input type="text" v-model="form.title" id="title" class="input" />
                <div v-if="form.errors.title" class="input-error">{{ form.errors.title }}</div>
            </div>
            <div class="mb-4">
                <label for="author">Author</label>
                <input type="text" v-model="form.author" id="author" class="input" />
                <div v-if="form.errors.author" class="input-error">{{ form.errors.author }}</div>
            </div>
            <div class="mb-4">
                <label for="description" class="label">Description</label>
                <textarea id="description" v-model="form.description"  class="input"></textarea>
                <div v-if="form.errors.description" class="input-error">{{ form.errors.description }}</div>
            </div>
            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <label for="category" class="label">Category</label>
                    <select id="category" v-model="form.category" class="input">
                        <option value="Fiction">Fiction</option>
                        <option value="Non-Fiction">Non-Fiction</option>
                        <option value="Science Fiction">Science Fiction</option>
                        <option value="Fantasy">Fantasy</option>
                        <option value="Biography">Biography</option>
                        <option value="Mystery">Mystery</option>
                        <option value="Romance">Romance</option>
                        <option value="Thriller">Thriller</option>
                    </select>
                    <div v-if="form.errors.category" class="input-error">{{ form.errors.category }}</div>
                </div>

                <div>
                    <label for="size" class="label">Size</label>
                    <input id="size" v-model="form.size" type="text" class="input" />
                    <div v-if="form.errors.title" class="input-error">{{ form.errors.title }}</div>
                </div>
            </div>
            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <label class="label">Cover book</label>
                    <div class="relative mt-2 flex items-center gap-2">
                        <input
                            id="title_path" @change="onFileChange($event, 'title_path')"
                            type="file" class="hidden"
                        />
                        <label for="title_path" class="input-file">
                            Choose Cover
                        </label>
                        <span v-if="form.title_path" class="text-sm text-gray-500">{{ form.title_path.name }}</span>
                    </div>
                    <div v-if="form.errors.title_path" class="input-error">{{ form.errors.title_path }}</div>
                </div>
                <div>
                    <label class="label">Book file</label>
                    <div class="relative mt-2 flex items-center gap-2">
                        <input
                            id="book_path" @change="onFileChange($event, 'book_path')"
                            type="file" class="hidden"
                        />
                        <label for="book_path" class="input-file">
                            Choose File
                        </label>
                        <span v-if="form.book_path" class="text-sm text-gray-500">{{ form.book_path.name }}</span>
                    </div>
                    <div v-if="form.errors.book_path" class="input-error">{{ form.errors.book_path }}</div>
                </div>
            </div>

            <button type="submit" class="btn-normal w-full">Add</button>
        </div>
    </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    title: '',
    author: '',
    description: '',
    category: '',
    size: 0,
    title_path: null,
    book_path: null,
})

const onFileChange = (event, field) => {
    const file = event.target.files[0];
    if (file) {
        if (file.size > 5 * 1024 * 1024) {
            alert('File size should not exceed 5MB')
            return;
        }
        form[field] = file
    }
}

const create = () => form.post(route('added-book.store'), {
    forceFormData: true,
})
</script>
