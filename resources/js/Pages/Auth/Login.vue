<template>
<form @submit.prevent="login">
    <div class="w-1/2 mx-auto">
        <div>
            <label for="email" class="label">Email</label>
            <input id="email" type="text" v-model="form.email" class="input" />
            <div v-if="form.errors.email" class="input-error">{{ form.errors.email }}</div>
        </div>

        <div>
            <label for="password" class="label">Password</label>
            <input id="password" type="password" v-model="form.password" class="input" />
            <div v-if="form.errors.password" class="input-error">{{ form.errors.password }}</div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn-normal w-full">Login</button>

            <div class="mt-2 text-center hover:text-orange-700">
                <Link href="#">Need an account? Click Here</Link>
            </div>
        </div>
    </div>
</form>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    email: null,
    password: null
})

const login = () => form.post(route('login.store'))
</script>
