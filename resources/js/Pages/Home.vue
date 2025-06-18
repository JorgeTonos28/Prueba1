<template>
  <div class="container mx-auto p-4">
    <input
      v-model="query"
      @input="onInput"
      type="text"
      class="w-full p-2 border rounded mb-4"
      placeholder="Escribe una palabra…"
    />
    <RhymeGrid :rhymes="rhymes" />
  </div>
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
