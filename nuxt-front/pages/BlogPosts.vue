<template>
  <div class="container mx-auto">
    <PostsTableComponent v-if="data" :posts="data.data" />
    <div v-else class="p-6 text-center text-gray-500">Завантаження постів...</div>
  </div>
</template>

<script setup>
// Робимо запит до Laravel API. .data — це масив постів, який повертає пагінація Laravel
const { data } = await useFetch('http://localhost:8000/api/blog/posts')
</script>