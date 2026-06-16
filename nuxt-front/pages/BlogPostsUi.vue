<template>
  <div class="p-6 container mx-auto">
    <h2 class="text-xl font-bold mb-4">Список постів (Компоненти Nuxt UI)</h2>

      <UTable :rows="posts" :columns="columns">
          <template #title-data="{ row }">
              <NuxtLink
                  :to="`/posts/${row.id}`"
                  class="text-blue-500 hover:text-blue-600 hover:underline font-semibold cursor-pointer"
              >
                  {{ row.title }}
              </NuxtLink>
          </template>
      </UTable>

    <div class="flex justify-end mt-4" v-if="totalPosts > 0">
      <UPagination
          v-model="page"
          :page-count="perPage"
          :total="totalPosts"
      />
    </div>
  </div>
</template>

<script setup>
const page = ref(1)
const perPage = ref(10)

// Динамічний запит до API залежно від поточної сторінки
const { data, pending } = await useFetch(() => `http://127.0.0.1:8000/api/blog/posts?page=${page.value}`)

// Опис колонок для компонента UTable
const columns = [
  { key: 'id', label: 'ID' },
  { key: 'title', label: 'Заголовок' },
  { key: 'category', label: 'Категорія' },
  { key: 'user', label: 'Автор' }
]

// Обчислювальні властивості для передачі в таблицю та пагінацію
const posts = computed(() => data.value?.data || [])
const totalPosts = computed(() => data.value?.total || 0)
</script>
