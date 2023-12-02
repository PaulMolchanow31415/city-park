<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthLayout from '@/Layouts/AuthLayout.vue';
import AppInput from '@/Components/AppInput.vue';
import InputError from '@/Components/InputError.vue';
import FormButtonDivider from '@/Components/FormButtonDivider.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { computed } from 'vue';

defineOptions({ layout: AuthLayout })

defineProps({
  canResetPassword: Boolean,
  status: String,
});

const form = useForm({
  email: '',
  password: '',
  remember: false,
})

const submit = () => {
  form.transform(data => ({
    ...data,
    remember: form.remember ? 'on' : '',
  })).post(route('login'), {
    onFinish: () => form.reset('password'),
  })
}

const errorMessage = computed(() => {
  return form.errors.email || form.errors.password ? 'Ошибка. Неправильно введен email или пароль' : ''
})
</script>

<template>
<Head title="Вход"/>

<div v-if="status" class="mb-4 font-medium text-sm text-green-600">
    {{ status }}
</div>

<form @submit.prevent="submit" class="w-2/3">
  <div>
    <AppInput v-model="form.email"
              label="Email"
              placeholder="test@mail.com"
              type="email"
              name="email"
              autocomplete="email"
              required
              class="w-full"
    />
  </div>

  <div class="mt-5">
    <AppInput label="Пароль"
              v-model="form.password"
              type="password"
              required
              autocomplete="new-password"
              class="w-full"
    />
    <InputError class="mt-2" :message="errorMessage"/>
    <!--    <Link v-if="canResetPassword"
              :href="route('password.request')"
              class="block pr-2.5 pt-2.5 text-right text-sm italic"
        >
          Забыли пароль?
        </Link>-->
  </div>

  <label class="mt-2.5 inline-flex items-center">
    <input v-model="form.remember" type="checkbox" class="form-checkbox rounded-sm">
    <span class="ml-2 select-none">Запомнить меня</span>
  </label>

  <PrimaryButton class="mt-10"
                 :class="{ 'opacity-25': form.processing }"
                 :disabled="form.processing"
  >
    Войти
  </PrimaryButton>

  <FormButtonDivider class="my-2.5">или</FormButtonDivider>

  <Link :href="route('register')" class="btn-1 text-center w-full">Зарегистрироваться</Link>
</form>
</template>
