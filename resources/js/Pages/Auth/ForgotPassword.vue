<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AppInput from '@/Components/AppInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AuthLayout from '@/Layouts/AuthLayout.vue';

defineProps({
    status: String,
});

defineOptions({
  layout: AuthLayout
})

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
<Head title="Восстановление пароля" />

<p class="mb-4 text-sm text-gray-600 text-center">
    Забыли свой пароль? Без проблем. Просто сообщите нам свой адрес электронной почты, и мы вышлем вам по электронной почте ссылку для сброса пароля, которая позволит вам выбрать новый.
</p>

<div v-if="status" class="mb-4 font-medium text-sm text-green-600">
    {{ status }}
</div>

<form @submit.prevent="submit" class="w-2/3">
  <div>
    <AppInput v-model="form.email"
              label="Email"
              placeholder="test@mail.com"
              type="email"
              autocomplete="email"
              required
              class="w-full"
    />
    <InputError class="mt-2" :message="form.errors.email"/>
  </div>

    <div class="flex items-center justify-end mt-4">
        <PrimaryButton :class="{ 'opacity-25': form.processing }"
                       :disabled="form.processing">
            Восстановить
        </PrimaryButton>
    </div>
</form>
</template>
