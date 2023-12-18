<script setup>
const props = defineProps(["gallery"]);

console.log(props.gallery);
</script>

<template>
  <div class="bg-slate-900 flex items-start justify-center p-4 min-h-screen">
    <h1
      class="text-slate-200 text-5xl font-semibold mb-4 underline decoration-sky-400"
    >
      Gallery View for {{ props.gallery.title }}
    </h1>

    <div v-for="image in props.gallery.images" :key="image.id">
      <img :src="image.image" alt="" />
    </div>
  </div>
</template>
