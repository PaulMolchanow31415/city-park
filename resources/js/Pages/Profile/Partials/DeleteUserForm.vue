<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import Modal from '@/Components/Modal.vue';
import AppInput from '@/Components/AppInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
  password: '',
});

const confirmUserDeletion = () => {
  confirmingUserDeletion.value = true;
};

const deleteUser = () => {
  form.delete(route('current-user.destroy'), {
    preserveScroll: true,
    onSuccess: () => closeModal(),
    onError: () => passwordInput.value.focus(),
    onFinish: () => form.reset(),
  });
};

const closeModal = () => {
  confirmingUserDeletion.value = false;
  form.reset();
};
</script>

<template>

<h1 class="mb-5">Удаление учетной записи</h1>
<div class="max-w-xl text-sm text-gray-600">
    Как только ваша учетная запись будет удалена, все ее ресурсы и данные будут удалены безвозвратно. Перед удалением вашей учетной записи, пожалуйста, загрузите любые данные или информацию, которые вы хотите сохранить.
</div>

<div class="mt-5">
    <button class="text-red-500" @click="confirmUserDeletion">
        Удалить учетную запись
    </button>
</div>

<!-- Delete Account Confirmation Modal -->
<Modal :show="confirmingUserDeletion" @close="closeModal">
  <div class="p-5">
    Вы уверены, что хотите удалить свою учетную запись? Как только ваша учетная запись будет удалена, все ее ресурсы и данные будут удалены безвозвратно. Пожалуйста, введите свой пароль, чтобы подтвердить, что вы хотите удалить свою учетную запись безвозвратно.
    <div class="mt-4">
        <AppInput
          ref="passwordInput"
          v-model="form.password"
          type="password"
          class="mt-1 block w-3/4"
          placeholder="Пароль"
          autocomplete="current-password"
          @keyup.enter="deleteUser"
          label="Удалить учетную запись"
        />
        <InputError :message="form.errors.password" class="mt-2"/>
    </div>

    <div class="flex items-center gap-2.5 mt-10">
      <button class="btn-1" @click="closeModal">Закрыть</button>

      <PrimaryButton
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
        @click="deleteUser"
        class="mt-0"
      >
          Удалить учетную запись
      </PrimaryButton>
    </div>
  </div>
</Modal>
</template>
