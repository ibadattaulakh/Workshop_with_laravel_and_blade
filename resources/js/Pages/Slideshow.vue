<script setup lang="ts">
import { ref, computed } from 'vue'
import { Head } from '@inertiajs/vue3'

const photos = ref<string[]>([
  'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1200&q=80',
  'https://images.unsplash.com/photo-1469474968028-56623f02e42e?auto=format&fit=crop&w=1200&q=80',
  'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?auto=format&fit=crop&w=1200&q=80',
])

const index = ref(0)
const audioStarted = ref(false)
const audioEl = ref<HTMLAudioElement | null>(null)

const currentPhoto = computed(() => photos.value[index.value])

function next() {
  index.value = (index.value + 1) % photos.value.length
  startAudioIfNeeded()
}

function prev() {
  index.value = (index.value - 1 + photos.value.length) % photos.value.length
  startAudioIfNeeded()
}

function startAudioIfNeeded() {
  if (!audioStarted.value && audioEl.value) {
    audioEl.value.play().catch(() => {
      // playback may fail if browser still blocks; that's OK
    })
    audioStarted.value = true
  }
}
</script>

<template>
  <Head title="Slideshow" />

  <div class="slideshow min-h-screen bg-black flex flex-col items-center justify-center p-4 relative overflow-hidden">
    <!-- Subtle Background Image -->
    <div
      class="absolute inset-0 opacity-20 bg-cover bg-center transition-all duration-500"
      :style="{ backgroundImage: `url(${currentPhoto})` }"
    ></div>

    <div class="relative z-10 flex flex-col items-center max-w-full">
      <div class="relative group">
        <img
          :src="currentPhoto"
          alt="slide"
          class="slide max-w-[90vw] max-h-[80vh] object-contain rounded-lg shadow-2xl transition-all duration-500"
        />
      </div>

      <div class="controls mt-8 flex gap-6">
        <button
          @click="prev"
          class="px-6 py-3 bg-white/10 hover:bg-white/20 text-white rounded-full backdrop-blur-md transition-all border border-white/20 text-2xl"
        >
          ‹
        </button>
        <button
          @click="next"
          class="px-6 py-3 bg-white/10 hover:bg-white/20 text-white rounded-full backdrop-blur-md transition-all border border-white/20 text-2xl"
        >
          ›
        </button>
      </div>
    </div>

    <!-- Background Audio -->
    <audio ref="audioEl" src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3" loop></audio>
  </div>
</template>

<style scoped>
.slideshow {
  background: radial-gradient(circle at center, #1a1a1a 0%, #000000 100%);
}

.slide {
  box-shadow: 0 0 50px rgba(0, 0, 0, 0.8);
}
</style>
