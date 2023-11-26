<script setup>
import { reactive } from 'vue';

const coords = [44.759662074600094, 39.874876999999984];
const react = reactive({
  isShowCloseBtn: false,
  isOpenPopup: true,
});

</script>

<template>
  <div @mouseenter="react.isShowCloseBtn = true"
       @mouseleave="react.isShowCloseBtn = false"
       class="relative">
    <YandexMap @dblclick="react.isOpenPopup = false" class="w-full h-[80vh]" :coords="coords"
               :scroll-zoom="false">
      <YmapMarker marker-id="1" hint-content="City Park" :coords="coords"/>
    </YandexMap>
    <button v-show="!react.isOpenPopup"
            @click="react.isOpenPopup = true"
            type="button"
            class="absolute top-2 left-1/2 transform -translate-x-1/4 text-white bg-shadow
                           px-4 py-1 rounded  transition hover:bg-dark">
      Открыть контактную информацию
    </button>
    <transition
      enter-active-class="transition ease-out duration-200"
      enter-from-class="transform opacity-0 scale-95"
      enter-to-class="transform opacity-100 scale-100"
      leave-active-class="transition ease-in duration-75"
      leave-from-class="transform opacity-100 scale-100"
      leave-to-class="transform opacity-0 scale-95"
    >
      <div v-show="react.isOpenPopup"
           class="absolute left-0 top-1/2 transform -translate-y-1/2 flex flex-col gap-10
                    py-10 pl-[2vh] pr-14 mr-2 bg-white rounded drop-shadow">
        <button @click="react.isOpenPopup = false"
                v-show="react.isShowCloseBtn"
                title="Скрыть"
                type="button"
                class="absolute right-2 top-2">
          <font-awesome-icon :icon="['fas', 'circle-xmark']"
                             size="xl"
                             class="text-border transition hover:text-dark"/>
        </button>
        <div class="line">
          <div class="pt-6 w-5">
            <font-awesome-icon :icon="['fas', 'location-dot']" size="lg" class="text-brown "/>
          </div>
          <p>
            <span class="title">Адрес</span> 352630, Краснодарский край, г. Белореченск, ул. Гоголя, 61.
          </p>
        </div>
        <div class="line">
          <div class="pt-6 w-5">
            <font-awesome-icon :icon="['fas', 'phone']" size="lg" class="text-brown"/>
          </div>
          <div>
            <span class="title">Телефоны</span>
            <ul>
              <li><a href="tel:88001002441" class="underline">8-800-100-24-41 (звонок по России бесплатный)</a></li>
              <li><a href="tel:79183119791" class="underline">+7-918-311-97-91 - ресторан</a></li>
              <li><a href="tel:79183119710" class="underline">+7-918-311-97-10 - гостиница</a></li>
            </ul>
          </div>
        </div>
        <div class="line">
          <div class="pt-6 w-5">
            <font-awesome-icon :icon="['fas', 'face-grin-wink']" size="lg" class="text-brown"/>
          </div>
          <div>
            <span class="title">Соц. сети</span>
            <ul>
              <li><a target="_blank" href="https://vk.com/cityparkvip" class="underline"> ВК: vk.com/cityparkvip </a>
              </li>
              <li><a target="_blank" href="https://ok.ru/cityparkvip" class="underline"> OК: ok.ru/cityparkvip </a></li>
              <li><a target="_blank" href="https://www.instagram.com/cityparkvipru/"
                     class="underline"> Instagram: cityparkvipru </a></li>
              <li><a target="_blank" href="mailto:belcitypark@mail.ru" class="underline"> e-mail:
                                                                                          belcitypark@mail.ru </a></li>
            </ul>
          </div>
        </div>
      </div>
    </transition>
  </div>
</template>

<style scoped lang="postcss">
.title {
  @apply font-serif text-brown block text-2xl mb-1 after:content-[':'];
}
.line {
  @apply flex gap-5;
}
</style>
