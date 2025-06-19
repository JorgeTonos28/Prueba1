<template>
  <main class="min-h-screen flex flex-col items-center px-4 py-12 bg-gradient-to-b from-white via-gray-50 to-white dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
    <h1 class="text-3xl font-bold mb-6">Buscador de rimas</h1>
    <input
      v-model="query"
      @input="onInput"
      type="text"
      class="w-full max-w-md p-3 border rounded-md shadow-sm focus:ring focus:ring-indigo-200 dark:bg-gray-800 dark:border-gray-700"
      placeholder="Escribe una palabra…"
    />
    <div class="mt-8 w-full max-w-3xl">
      <RhymeGrid :rhymes="rhymes" />
    </div>
  </main>
</template>

<script setup lang="ts">
import { ref, watch } from 'vue';
import { useDebounce } from '../composables/useDebounce';
import RhymeGrid from '../Components/RhymeGrid.vue';

const query = ref('');
const rhymes = ref([] as string[]);

const fetchRhymes = async (word: string) => {
  if (!word) {
    rhymes.value = [];
    return;
  }
  try {
    const res = await axios.get(`/api/rhymes`, { params: { word } });
    rhymes.value = res.data.rhymes;
  } catch (e) {
    rhymes.value = [];
  }
};

const onInput = () => debounce(query.value);

const debounce = useDebounce(fetchRhymes, 300);
</script>
