<template>
  <div class="p-6">
    <h2 class="text-xl font-bold mb-4">Список постів (Звичайна HTML Таблиця)</h2>
    <table class="min-w-full border-collapse border border-gray-300">
      <thead>
      <tr class="bg-gray-100">
        <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
        <th class="border border-gray-300 px-4 py-2 text-left">Заголовок</th>
        <th class="border border-gray-300 px-4 py-2 text-left">Категорія</th>
        <th class="border border-gray-300 px-4 py-2 text-left">Автор</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="post in posts" :key="post.id" class="hover:bg-gray-50">
        <td class="border border-gray-300 px-4 py-2">{{ post.id }}</td>
        <td class="border border-gray-300 px-4 py-2 font-medium">{{ post.title }}</td>
        <td class="border border-gray-300 px-4 py-2 text-gray-600">
          {{ post.category ? post.category.title : 'Без категорії' }}
        </td>
        <td class="border border-gray-300 px-4 py-2 text-gray-600">
          {{ post.user ? post.user.name : 'Невідомий' }}
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
defineProps({
  posts: {
    type: Array,
    required: true
  }
})
</script>