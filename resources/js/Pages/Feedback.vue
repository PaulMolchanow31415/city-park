<script>
import { defineComponent } from 'vue';
import { QuillEditor } from '@vueup/vue-quill';
import { Head } from '@inertiajs/vue3';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import TitleUnderlined from '@/Components/TitleUnderlined.vue';
import { useBreadcrumbs } from '@/Composables/index.js';
import AppInput from '@/Components/AppInput.vue';
import PhoneInput from '@/Components/PhoneInput.vue';
import HtmlEditor from '@/Components/HtmlEditor.vue';
// https://vueup.github.io/vue-quill/api/#:~:text=QuillEditor%20component%20globally-,Usage%3A,-js

export default defineComponent({
  components: { HtmlEditor, PhoneInput, AppInput, TitleUnderlined, Breadcrumbs, QuillEditor, Head },
  data() {
    return {
      message: '',
      name: '',
      email: '',
      theme: '',
    }
  },
  setup() {
    const breadcrumbs = useBreadcrumbs()
    const pageTitle = breadcrumbs.value[breadcrumbs.value.length - 1].title
    return { breadcrumbs, pageTitle }
  },
})
</script>

<template>
    <Head :title="pageTitle"/>
    <div class="container mt-10">
        <Breadcrumbs class="text-center" :breadcrumbs="breadcrumbs"/>
        <h6 class="text-center mt-5 mb-10">{{ pageTitle }}</h6>

        <form class="flex flex-col gap-10 items-center"
              @submit.prevent="console.log('form submitting...')">
            <div class="flex flex-col max-w-[400px] gap-5">
                <AppInput label="Имя" v-model.trim="name" placeholder="Имя"/>
                <AppInput label="Email" v-model="email" type="email" placeholder="test@mail.com"/>
                <AppInput label="Тема" v-model="theme" placeholder="Тема"/>
                <div class="mt-5">
                  <HtmlEditor v-model="message" />
                </div>
            </div>
            <button class="btn-3" type="submit">
                <font-awesome-icon :icon="['fas', 'paper-plane']"/>
                Отправить
            </button>
        </form>
    </div>

</template>

