<template>
    <header class="block bg-amber-950 w-full text-slate-300 text-xl text-wrap text-center">
        <div class="container mx-auto">
            <nav class="p-4 flex items-center justify-between text-yellow-500">
                <div class="text-yellow-300 font-serif text-2xl yellow-light">
                    <Link :href="route('book.index')">Clibrity</Link>
                </div>

                <div v-if="user" class="flex items-center gap-6">
                    <Link class="yellow-light">{{ user.name }}</Link>
                    <Link :href="route('bookshelf')" class="yellow-light">Bookshelf</Link>
                    <Link :href="route('added-book.index')" class="yellow-light">Added by Me</Link>
                    <Link :href="route('logout')" method="delete" as="button" class="yellow-light">Logout</Link>
                </div>
                <div v-else class="flex items-center gap-2">
                    <Link :href="route('register.create')" class="yellow-light">Register</Link>
                    <Link :href="route('login')" class="yellow-light">Sign-in</Link>
                </div>
            </nav>
        </div>
    </header>

    <main class="bg-amber-50 mx-auto w-3/4 min-h-screen  shadow-lg p-6">
        <div v-if="flashSuccess" class="mb-4 border border-dashed rounded-md border-green-600 bg-green-50 text-emerald-800 font-medium shadow-sm p-2">
            {{ flashSuccess }}
        </div>
        <slot>Default</slot>
    </main>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage()

const flashSuccess = computed(() => page.props.flash.success)

const user = computed(
    () => page.props.user
)

</script>
