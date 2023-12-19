<script setup>
import { ref } from "vue";
import VueEasyLightbox from "vue-easy-lightbox";
const props = defineProps(["gallery"]);
const lightBoxVisible = ref(false);
const imageIndex = ref(0);
const images = ref(props.gallery.images);
// const images = ref([
//   "https://dummyimage.com/600x400/fff/000",
//   "https://dummyimage.com/600x400/fff/000",
//   "https://dummyimage.com/600x400/fff/000",
//   "https://dummyimage.com/600x400/fff/000",
//   "https://dummyimage.com/600x400/fff/000",
//   "https://dummyimage.com/600x400/fff/000",
//   "https://dummyimage.com/600x400/fff/000",
//   "https://dummyimage.com/600x400/fff/000",
//   "https://dummyimage.com/600x400/fff/000",
//   "https://dummyimage.com/600x400/fff/000",
//   "https://dummyimage.com/600x400/fff/000",
//   "https://dummyimage.com/600x400/fff/000",
//   "https://dummyimage.com/600x400/fff/000",
//   "https://dummyimage.com/600x400/fff/000",
//   "https://dummyimage.com/600x400/fff/000",
//   "https://dummyimage.com/600x400/fff/000",
//   "https://dummyimage.com/600x400/fff/000",
//   "https://dummyimage.com/600x400/fff/000",
//   "https://dummyimage.com/600x400/fff/000",
//   "https://dummyimage.com/600x400/fff/000",
//   "https://dummyimage.com/600x400/fff/000",
//   "https://dummyimage.com/600x400/fff/000",
//   "https://dummyimage.com/600x400/fff/000",
//   "https://dummyimage.com/600x400/fff/000",
//   "https://dummyimage.com/600x400/fff/000",
//   "https://dummyimage.com/600x400/fff/000",
//   "https://dummyimage.com/600x400/fff/000",
//   "https://dummyimage.com/600x400/fff/000",
//   "https://dummyimage.com/600x400/fff/000",
//   "https://dummyimage.com/600x400/fff/000",
//   "https://dummyimage.com/600x400/fff/000",
//   "https://dummyimage.com/600x400/fff/000",
//   "https://dummyimage.com/600x400/fff/000",
//   "https://dummyimage.com/600x400/fff/000",
//   "https://dummyimage.com/600x400/fff/000",
//   "https://dummyimage.com/600x400/fff/000",
//   "https://dummyimage.com/600x400/fff/000",
//   "https://dummyimage.com/600x400/fff/000",
//   "https://dummyimage.com/600x400/fff/000",
//   "https://dummyimage.com/600x400/fff/000",
// ]);

const onHide = () => (lightBoxVisible.value = false);

const openLightBox = (index) => {
  imageIndex.value = index;
  lightBoxVisible.value = !lightBoxVisible.value;
};

const downloadImage = async (url) => {
  const response = await fetch(url);
  console.log("Response: ", response);

  if (!response.ok) {
    throw new Error(`HTTP error! status: ${response.status}`);
  }

  const data = await response.blob();
  console.log("Blob size: ", data.size);

  if (data.size === 0) {
    throw new Error(
      "Blob is empty. The file might not have been fetched correctly."
    );
  }

  // Create a new object URL for the file
  const fileUrl = window.URL.createObjectURL(data);

  // Get MIME type from the response
  const mimeType = data.type;
  let extension = "";

  // Determine the file extension based on the MIME type
  switch (mimeType) {
    case "application/pdf":
      extension = ".pdf";
      break;
    case "image/jpeg":
      extension = ".jpg";
      break;
    case "image/png":
      extension = ".png";
      break;
    case "text/plain":
      extension = ".txt";
      break;
    // Add more cases as needed
    default:
      extension = "";
      break;
  }

  // Generate a random number and get the current time
  const timestamp = Date.now(); // Current time in milliseconds

  // Create a filename with random number, timestamp, and file index
  const filename = `${props.gallery.title}_${timestamp}_${extension}`;

  // Create a temporary anchor element and trigger the download
  const a = document.createElement("a");
  a.href = fileUrl;
  a.download = filename;
  `downloaded_file_${images.value[imageIndex.value]}`; // Set the file name with index
  document.body.appendChild(a);
  a.click();

  // Clean up by removing the element and revoking the object URL
  document.body.removeChild(a);
  window.URL.revokeObjectURL(fileUrl);
};
</script>

<template>
  <div
    class="container min-h-screen px-8 py-10 mx-auto text-white bg-no-repeat bg-cover"
    style="background-image: url('/assets/images/bg.jpg')"
  >
    <div class="flex flex-col items-center justify-center mb-8">
      <div class="mb-10 text-center">
        <h3 class="mb-5 text-xl font-bold tracking-wider uppercase">
          F-SKY FILM
        </h3>
        <p class="text-xs">Capture, View, and Cherish Your Moments Instantly</p>
      </div>
      <p class="text-sm">{{ props.gallery.title }}</p>
    </div>

    <div class="relative flex flex-col justify-center py-4 sm:py-12">
      <div
        class="columns-2 md:columns-3 lg:columns-4 2xl:columns-6 gap-5 [column-fill:_balance] box-border mx-auto before:box-inherit after:box-inherit"
      >
        <div
          class="mb-5 break-inside-avoid"
          v-for="(image, index) in images"
          :key="index"
        >
          <img
            class="rounded-sm shadow-sm"
            @click="openLightBox(index)"
            :src="image"
          />
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
              <button @click="downloadImage(images[imageIndex])">
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
