<script setup>
import { ref } from "vue";
import FsLightbox from "fslightbox-vue/v3";
import VueEasyLightbox from "vue-easy-lightbox";
const props = defineProps(["gallery"]);
const lightBoxVisible = ref(false);
const imageIndex = ref(0);
const images = ref([
  "https://dummyimage.com/600x100/fff/000",
  "https://dummyimage.com/600x200/fff/000",
  "https://dummyimage.com/600x300/fff/000",
  "https://dummyimage.com/600x400/fff/000",
  "https://dummyimage.com/600x500/fff/000",
  "https://dummyimage.com/600x600/fff/000",
  "https://dummyimage.com/600x700/fff/000",
  "https://dummyimage.com/600x800/fff/000",
]);

const onHide = () => (lightBoxVisible.value = false);

const openLightBox = (index) => {
  imageIndex.value = index;
  lightBoxVisible.value = !lightBoxVisible.value;
};
</script>

<template>
  <div
    class="flex flex-col items-center justify-start min-h-screen p-4 bg-slate-900"
  >
    <h1
      class="mb-4 text-5xl font-semibold underline text-slate-200 decoration-sky-400"
    >
      Gallery View for {{ props.gallery.title }}
    </h1>
    <!-- <div>
      <button @click="toggler = !toggler">Open the lightbox.</button>
      <FsLightbox :toggler="toggler" :sources="props.gallery.images" />
    </div> -->
    <!-- <div v-for="(image, index) in props.gallery.images" :key="index">
      <img :src="image" alt="" />
    </div> -->
    <div
      class="relative flex flex-col justify-center min-h-screen py-6 sm:py-12"
    >
      <div
        class="columns-2 md:columns-3 lg:columns-4 2xl:columns-6 gap-5 [column-fill:_balance] box-border mx-auto before:box-inherit after:box-inherit"
      >
        <div
          class="mb-5 break-inside-avoid"
          v-for="(image, index) in images"
          :key="index"
        >
          <img @click="openLightBox(index)" :src="image" />
        </div>
      </div>
      <vue-easy-lightbox
        :visible="lightBoxVisible"
        :imgs="images"
        :index="imageIndex"
        @hide="onHide"
      >
        <template v-slot:toolbar="{ toolbarMethods }">
          <div
            class="absolute inset-x-0 flex items-center justify-center gap-10 text-white bottom-10"
          >
            <div
              class="flex items-center justify-center gap-4 p-1 px-4 bg-gray-900 rounded shadow"
            >
              <button @click="toolbarMethods.zoomIn">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="w-6 h-6"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607zM10.5 7.5v6m3-3h-6"
                  />
                </svg>
              </button>
              <button @click="toolbarMethods.zoomOut">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="w-6 h-6"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607zM13.5 10.5h-6"
                  />
                </svg>
              </button>
              <button @click="toolbarMethods.rotateLeft">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="w-6 h-6"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3"
                  />
                </svg>
              </button>
              <button @click="toolbarMethods.rotateRight">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="w-6 h-6"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M15 15l6-6m0 0l-6-6m6 6H9a6 6 0 000 12h3"
                  />
                </svg>
              </button>
              <button @click="toolbarMethods.rotateRight">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="w-6 h-6"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"
                  />
                </svg>
              </button>
            </div>
          </div>
        </template>
      </vue-easy-lightbox>
    </div>
  </div>
</template>
