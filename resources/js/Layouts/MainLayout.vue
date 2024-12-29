<template>
    <header class="block bg-amber-950 w-full text-slate-300 text-xl text-wrap text-center">
        <div class="container mx-auto">
            <nav class="p-4 flex items-center justify-between text-yellow-500">
                <div class="text-yellow-300 font-serif text-2xl">
                    <Link :href="route('book.index')">Clibrity</Link>
                </div>

                <div v-if="user">
                    <Link :href="route('logout')" method="delete" as="button">Logout</Link>
                </div>
                <div v-else class="flex items-center gap-2">
                    <Link href="#">Register</Link>
                    <Link :href="route('login')">Sign-in</Link>
                </div>
            </nav>
        </div>
    </header>

    <main class="bg-amber-50 mx-auto w-3/4 min-h-screen  shadow-lg p-6">
        <slot>Default</slot>
    </main>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage()

const user = computed(
    () => page.props.user
)

</script>
