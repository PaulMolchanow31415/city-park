<script setup>
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import NewsCard from '@/Components/NewsCard.vue';
import TitleUnderlined from '@/Components/TitleUnderlined.vue';
import { useBreadcrumbs } from '@/Composables/index.js';
import { Head } from '@inertiajs/vue3';
import { reactive } from 'vue';

const props = defineProps({ news: Object })

const news = reactive({
  data: props.news.data,
  showLoadBtn: true,
})

function handleLoadNews() {
  axios.get(route('rest.news.all'))
  .then(res => {
    news.data.splice(0, news.data.length, ...res.data.news)
    news.showLoadBtn = false
  })
}

const breadcrumbs = useBreadcrumbs()
const pageTitle = breadcrumbs.value[breadcrumbs.value.length - 1].title
</script>

<template>
    <Head :title="pageTitle"/>

    <div class="container mt-20">
        <Breadcrumbs :breadcrumbs="breadcrumbs"/>
        <TitleUnderlined as="h2" class="mt-5 mb-10 ml-5">{{ pageTitle }}</TitleUnderlined>
        <div class="gap-5 grid grid-cols-2 grid-flow-dense auto-rows-min ">
              <NewsCard v-for="(item, index) in news.data"
                        :data="item"
                        :key="item.id"
                        :size="index === 0 ? 'lg':'md'"
                        class="place-self-start"
                        :class="{ 'row-span-3': index === 0}"
              />
        </div>
        <div class="flex justify-center mt-10">
            <button v-if="news.showLoadBtn"
                    @click="handleLoadNews"
                    type="button"
                    class="btn-2 px-10 text-dark bg-white border-dark hover:bg-dark hover:text-white"
            >
                <font-awesome-icon :icon="['fas', 'arrow-down']" size="sm"/>Ещё
            </button>
        </div>
    </div>
</template>

<style scoped lang="postcss">

</style>
