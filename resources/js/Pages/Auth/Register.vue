<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppInput from '@/Components/AppInput.vue';
import InputError from '@/Components/InputError.vue';
import PhoneInput from '@/Components/PhoneInput.vue';
import FormButtonDivider from '@/Components/FormButtonDivider.vue';
import BlankLayout from '@/Layouts/AuthLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

defineOptions({ layout: BlankLayout })

const form = useForm({
  name: '',
  email: '',
  phone: '',
  password: '',
  password_confirmation: '',
});

const submit = () => {
  form.post(route('register'), {
    onFinish: () => form.reset('password', 'password_confirmation'),
  });
}
</script>

<template>
<Head title="Регистрация"/>

<form @submit.prevent="submit" class="max-w-md w-full">
  <div class="flex flex-col gap-5 items-stretch">
    <div>
      <AppInput v-model="form.name"
                label="Имя"
                placeholder="Имя"
                autocomplete="name"
                required
                class="w-full"
      />
      <InputError class="mt-2" :message="form.errors.name"/>
    </div>

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

    <div>
      <PhoneInput v-model="form.phone" class="w-full"/>
      <InputError class="mt-2" :message="form.errors.phone"/>
    </div>

    <div>
      <AppInput label="Пароль"
                v-model="form.password"
                type="password"
                required
                autocomplete="new-password"
                class="w-full"
      />
      <InputError class="mt-2" :message="form.errors.password"/>
    </div>

    <div>
        <AppInput
          label="Повторите пароль"
          v-model="form.password_confirmation"
          type="password"
          class="mt-1 block w-full"
          required
          autocomplete="new-password"
        />
        <InputError class="mt-2" :message="form.errors.password_confirmation"/>
    </div>
  </div>

  <PrimaryButton :class="{ 'animate-pulse opacity-25 ': form.processing }"
                 :disabled="form.processing"
                 class="mt-10">
    Зарегистрироваться
  </PrimaryButton>

  <FormButtonDivider class="mt-10 mb-2.5">Если у вас уже есть аккаунт</FormButtonDivider>

  <Link :href="route('login')" class="btn-1 text-center w-full">Войти</Link>
</form>
</template>
