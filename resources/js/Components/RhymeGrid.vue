<template>
  <div aria-live="polite" class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    <template v-for="(items, letter) in grouped" :key="letter">
      <section>
        <h2 class="text-lg font-semibold mb-2 text-indigo-600">{{ letter.toUpperCase() }}</h2>
        <div class="space-y-1">
          <div
            v-for="r in items"
            :key="r"
            class="p-2 rounded-md bg-white dark:bg-gray-800 shadow"
          >
            {{ r }}
          </div>
        </div>
      </section>
    </template>
  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue';
const props = defineProps<{ rhymes: string[] }>();

const grouped = computed(() => {
  const groups: Record<string, string[]> = {};
  for (const r of props.rhymes) {
    const letter = r.charAt(0).toUpperCase();
    if (!groups[letter]) groups[letter] = [];
    groups[letter].push(r);
  }
  return groups;
});
</script>
