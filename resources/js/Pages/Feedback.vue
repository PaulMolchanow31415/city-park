<script>
import { defineComponent } from 'vue';
import { QuillEditor } from '@vueup/vue-quill';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import TitleUnderlined from '@/Components/TitleUnderlined.vue';
import { useBreadcrumbs } from '@/Composables/index.js';
import AppInput from '@/Components/AppInput.vue';
import PhoneInput from '@/Components/PhoneInput.vue';
import HtmlEditor from '@/Components/HtmlEditor.vue';
// https://vueup.github.io/vue-quill/api/#:~:text=QuillEditor%20component%20globally-,Usage%3A,-js

export default defineComponent({
  components: { HtmlEditor, PhoneInput, AppInput, TitleUnderlined, Breadcrumbs, QuillEditor, Head },
  setup() {
    const breadcrumbs = useBreadcrumbs()
    const pageTitle = breadcrumbs.value[breadcrumbs.value.length - 1].title
    const page = usePage()
    const { user } = page.props.auth
    let name, email;

    if (user) {
      name = user.name || ''
      email = user.email || ''
    }
    const form = useForm({
      message: '',
      name: name,
      email: email,
      theme: '',
    })
    return { breadcrumbs, pageTitle, form }
  },
  methods: {
    submit() {
      this.form.post(route('feedback.store'), {
        //
      })
    },
  },
})
</script>

<template>
    <Head :title="pageTitle"/>
    <div class="container mt-10">
        <Breadcrumbs class="text-center" :breadcrumbs="breadcrumbs"/>
        <h6 class="text-center mt-5 mb-10">{{ pageTitle }}</h6>

        <form class="flex flex-col gap-10 items-center" @submit.prevent="submit">
            <div class="flex flex-col max-w-[400px] gap-5">
                <AppInput label="Имя" v-model.trim="form.name" placeholder="Имя"/>
                <AppInput label="Email" v-model="form.email" type="email" placeholder="test@mail.com"/>
                <AppInput label="Тема" v-model="form.theme" placeholder="Тема"/>
                <div class="mt-5">
                  <HtmlEditor v-model="form.message"/>
                </div>
            </div>
            <button class="btn-3" type="submit"
                    :disabled="form.processing"
                    :class="{'opacity-75': form.processing}"
            >
                <font-awesome-icon :icon="['fas', 'paper-plane']"/>
                Отправить
            </button>
        </form>
    </div>

</template>

