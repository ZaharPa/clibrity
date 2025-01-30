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

        <div v-if="form.errors.captcha" class="input-error">
            {{ form.errors.captcha }}
        </div>

        <div class="mt-4">
            <button type="submit" :disabled="form.processing"  class="btn-normal w-full">
                {{ form.processing ? 'Logging in...' : 'Login' }}
            </button>

            <div class="mt-2 text-center hover:text-orange-700">
                <Link :href="route('register.create')">Need an account? Click Here</Link>
            </div>
        </div>
    </div>
</form>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/vue3';
import { onMounted } from 'vue';

const form = useForm({
    email: null,
    password: null,
    captcha: ''
});

const login = async() => {
    form.errors.captcha = '';

    try {
        const recaptchaToken = await grecaptcha.execute('6LfovscqAAAAAK10j_EYdfzD6EAE0pRk03Cbxc3u', {action: 'login'});
        form.captcha = recaptchaToken;
    } catch (error) {
        form.errors.captcha = 'CAPTCHA validation failed. Please try again.';
        return;
    }

    form.post(route('login.store'))
};

onMounted(() => {
    const script = document.createElement('script');
    script.src = 'https://www.google.com/recaptcha/api.js?render=6LfovscqAAAAAK10j_EYdfzD6EAE0pRk03Cbxc3u';
    script.async = true;
    script.defer = true;
    document.head.appendChild(script);
});
</script>

