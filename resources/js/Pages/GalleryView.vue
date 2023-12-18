<script setup>
import { ref } from "vue";
import FsLightbox from "fslightbox-vue/v3";

const props = defineProps(["gallery"]);
const toggler = ref(false);

console.log(props.gallery);
</script>

<template>
  <div
    class="bg-slate-900 flex flex-col items-center justify-start p-4 min-h-screen"
  >
    <h1
      class="text-slate-200 text-5xl font-semibold mb-4 underline decoration-sky-400"
    >
      Gallery View for {{ props.gallery.title }}
    </h1>
    <div>
      <button @click="toggler = !toggler">Open the lightbox.</button>
      <FsLightbox :toggler="toggler" :sources="props.gallery.images" />
    </div>
    <div v-for="(image, index) in props.gallery.images" :key="index">
      <img :src="image" alt="" />
    </div>
  </div>
</template>
