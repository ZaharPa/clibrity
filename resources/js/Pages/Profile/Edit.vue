<template>
    <div class="w-2/3 mx-auto">
        <h1 class="text-center text-2xl text-orange-600 mb-4">Edit Profile</h1>
        <form @submit.prevent="updateProfile" class="flex flex-col gap-3">
            <div>
                <label for="name" class="label">Name: {{ user.name }}</label>
                <input type="text" v-model="formProfile.name" id="name" class="input" />
                <div v-if="formProfile.errors.name" class="input-error">{{ formProfile.errors.name }}</div>
            </div>

            <div>
                <label for="password_old" class="label" >Old Password</label>
                <input type="password" v-model="formProfile.password_old" id="password_old" class="input" />
                <div v-if="formProfile.errors.password_old" class="input-error">{{ formProfile.errors.password_old }}</div>
            </div>

            <div>
                <label for="password_new" class="label">New Password</label>
                <input type="password" v-model="formProfile.password_new" id="password_new" class="input" />
                <div v-if="formProfile.errors.password_new" class="input-error">{{ formProfile.errors.password_new }}</div>
            </div>
            {{ props }}
            <div class="items-center flex flex-col mt-2">
                <button type="submit" class="btn-normal w-2/3">Save</button>
            </div>
        </form>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    user: Object
})

const formProfile = useForm({
    name: props.user.name,
    password_old: null,
    password_new: null
})

const updateProfile = () => {
    formProfile.put(route('profile.update', {profile: props.user.id}))
}
</script>
