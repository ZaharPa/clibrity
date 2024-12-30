<template>
    <div class="w-full text-center text-xl text-amber-700 font-medium p-8 pb-10 border-4 border-dotted border-amber-300">
        <span>
            You need be verified first to see this page
        </span>

        <div>
            <Link
                :href="route('verification.send')"
                method="post" as="button"
                class="text-orange-400 hover:text-yellow-500 mt-4"
            >
                Resend verification email
            </Link>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

</script>
