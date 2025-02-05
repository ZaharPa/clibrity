<template>
    <form @submit.prevent="register">
        <div class="w-1/2 mx-auto">
            <div>
                <label for="name" class="label">Name</label>
                <input id="name" v-model="form.name" type="text" class="input" />
                <div v-if="form.errors.name" class="input-error">{{ form.errors.name }}</div>
            </div>

            <div class="mt-4">
                <label for="email" class="label">Email</label>
                <input id="email" v-model="form.email" type="text" class="input" />
                <div v-if="form.errors.email" class="input-error">{{ form.errors.email }}</div>
            </div>

            <div class="mt-4">
                <label for="password" class="label">Password</label>
                <input id="password" v-model="form.password" type="password" class="input" />
                <div v-if="form.errors.password" class="input-error">{{ form.errors.password }}</div>
            </div>

            <div class="mt-4">
                <label for="password_confirmation" class="label">Confirm password</label>
                <input id="password_confirmation" v-model="form.password_confirmation" type="password" class="input" />
                <div v-if="passwordMismatch" class="input-error">Passwords do no match</div>
            </div>

            <div v-if="form.errors.captcha" class="input-error">
                {{ form.errors.captcha }}
            </div>

            <div class="mt-4">
                <button type="submit"
                    :disabled="passwordMismatch" :class="{
                        'btn-normal w-full': true,
                        'bg-gray-500 cursor-not-allowed hover:bg-gray-500': passwordMismatch
                    }"
                >Create account</button>

                <div class="mt-2 text-center hover:text-orange-700">
                    <Link :href="route('login')">Already have an account? Click Here</Link>
                </div>
            </div>
        </div>
    </form>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/vue3';
import { computed, onMounted } from 'vue';

const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
    captcha: ''
})

const passwordMismatch = computed(() => {
    return form.password && form.password_confirmation && form.password !== form.password_confirmation
})

const register = async () => {
    form.errors.captcha = '';

    try {
        const recaptchaToken = await grecaptcha.execute('6LfovscqAAAAAK10j_EYdfzD6EAE0pRk03Cbxc3u', {action: 'login'});
        form.captcha = recaptchaToken;
    } catch (error) {
        form.errors.captcha = 'CAPTCHA validation failed. Please try again.';
        return;
    }

    form.post(route('register.store'))
};

onMounted(() => {
    const script = document.createElement('script');
    script.src = 'https://www.google.com/recaptcha/api.js?render=6LfovscqAAAAAK10j_EYdfzD6EAE0pRk03Cbxc3u';
    script.async = true;
    script.defer = true;
    document.head.appendChild(script);
});
</script>
