<template>
    <div>
        <div class="grid grid-cols-6 mb-4">
            <div>
                <img :src="book.title_url" alt="" />
            </div>
            <div class="col-span-5 text-center flex flex-col justify-center pb-6">
                <h1 class="text-2xl mb-4 text-amber-600">{{ book.title }}</h1>
                <p class="text-xl mb-2 text-amber-700">{{ book.author }}</p>
                <p class="mb-2 text-amber-800 text-lg">
                    <span>
                        {{ book.category + ' '}}
                    </span>
                    <span>
                        {{ book.size }} pages
                    </span>
                </p>
                <p class="text-amber-900">
                    <span>
                        Published by {{ book.publisher?.name }}
                    </span>
                    <span>
                        at {{ formatDate(book.created_at) }}
                    </span>
                </p>
            </div>
        </div>

        <div>
            <label for="status" class="">Status</label>
            <select name="status"
                id="status" class="rounded-md px-5 py-0 ml-2 border-yellow-400 focus:border-orange-600 focus:ring-0 focus:bg-orange-50"
                v-model="status" @change="updateStatus"
            >
                <option value="unread">Unread</option>
                <option value="reading">Reading</option>
                <option value="read">Read</option>
            </select>
        </div>

        <span class="text-xl text-amber-700">Description</span>
        <p class="text-amber-950 mb-4">{{ book.description }}</p>

        <div>
            <iframe :src="book.book_url" class="w-full h-[600px] rounded-lg shadow-lg" />
            <a :href="book.book_url" target="_blank" class="block text-amber-700 hover:text-orange-600 text-center mt-2 font-medium">Open PDF</a>
        </div>

        <div class="mt-2">
            <label for="notes" class="label">Notes</label>
            <textarea id="notes" v-model="notes" @change="updateNotes" class="input">
            </textarea>
        </div>

        <div class="mt-6">
            <form class="border border-orange-700 bg-yellow-100 p-4 rounded-md shadow-md">
                <span class="label">Leave your review book here</span>
                <select class="input">
                    <option :value="null">Rating</option>
                    <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
                </select>
                <input type="text" placeholder="Text comment here" class="input mt-2" />
                <button class="btn-light mt-2">Send</button>
            </form>
        </div>

        <div class="mt-6 border border-dashed border-amber-700 p-4 rounded-md shadow-lg text-amber-800">
            No comment yet
        </div>
    </div>
</template>

<script setup>
defineProps({
    book: Object
})

const formatDate = (date) => {
    const options = { year: 'numeric', month: 'long', day: 'numeric'}
    return new Date(date).toLocaleDateString('en-GB', options)
}
</script>
