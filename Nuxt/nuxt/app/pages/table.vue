<script setup>
import { ref, computed } from 'vue'
import { useSubscriptionStore } from '~/stores/useSubscriptionStore'

// 1. Отримуємо дані для таблиці
const { data } = await useFetch('/api/products')

// 2. Підключаємо стор Pinia
const store = useSubscriptionStore()

// 3. Функція для кнопки (зберігаємо товар у стор і переходимо на оплату)
function buyPlan(item) {
  const planInfo = {
    planName: item.title,
    price: item.price,
    oldPrice: item.price + 50,
    newPrice: item.price,
    savings: 189,
    features: [
      `Brand: ${item.brand || 'No brand'}`,
      `Category: ${item.category}`,
      item.description
    ]
  }

  store.setPlan(planInfo)
  navigateTo('/checkout')
}

// 4. Логіка таблиці (пошук, пагінація)
const search = ref('')
const page = ref(1)
const pageSize = 5
const sort = ref({ column: 'title', direction: 'asc' })

// ДОДАВ КОЛОНКУ 'actions' ДЛЯ КНОПКИ
const columns = [
  { id: 'thumbnail', accessorKey: 'thumbnail', header: 'Фото' },
  { id: 'title', accessorKey: 'title', header: 'Назва' },
  { id: 'description', accessorKey: 'description', header: 'Опис' },
  { id: 'price', accessorKey: 'price', header: 'Ціна' },
  { id: 'rating', accessorKey: 'rating', header: 'Оцінка' },
  { id: 'category', accessorKey: 'category', header: 'Категорія' },
  { id: 'actions', header: 'Дія' } // <--- Наша нова колонка
]

const filteredData = computed(() => {
  let arr = data.value?.products || []

  if (search.value) {
    arr = arr.filter(p =>
      p.title.toLowerCase().includes(search.value.toLowerCase()) ||
      p.description.toLowerCase().includes(search.value.toLowerCase())
    )
  }

  if (sort.value.column) {
    arr = [...arr].sort((a, b) => {
      const aVal = a[sort.value.column]
      const bVal = b[sort.value.column]
      if (aVal === bVal) return 0
      const res = aVal > bVal ? 1 : -1
      return sort.value.direction === 'desc' ? -res : res
    })
  }
  return arr
})

const paginatedRows = computed(() => {
  const start = (page.value - 1) * pageSize
  return filteredData.value.slice(start, start + pageSize)
})
</script>

<template>
  <div class="bg-gray-100 p-8 font-sans text-gray-800 min-h-screen">
    <Head>
      <Title>Lab 5 - Table</Title>
      <Link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    </Head>

    <div class="max-w-7xl mx-auto">
      <div class="flex justify-between items-center mb-4 text-sm text-gray-600">
        <div class="flex items-center gap-6">
          <div class="flex items-center gap-2">
            <input type="checkbox" class="rounded border-gray-300">
            <i class="fa-solid fa-chevron-down text-xs"></i>
          </div>
          <UInput v-model="search" placeholder="Пошук..." class="w-64" />
        </div>

        <div class="flex items-center gap-6 font-medium">
          <button class="hover:text-black"><i class="fa-regular fa-window-maximize mr-1"></i> Display</button>
          <button class="hover:text-black"><i class="fa-solid fa-list mr-1"></i> Sort by</button>
          <button class="hover:text-black"><i class="fa-solid fa-ellipsis mr-1"></i> Actions</button>
        </div>
      </div>

      <div class="bg-white rounded-lg shadow border border-gray-200 overflow-x-auto">
        <UTable
          :data="paginatedRows"
          :columns="columns"
          :ui="{
            wrapper: '',
            th: { base: 'py-3 px-4 font-medium text-center text-gray-500 bg-gray-50 border-b border-gray-200' },
            td: { base: 'py-4 px-4 text-center border-b border-gray-100' },
            tr: { base: 'even:bg-gray-50 hover:bg-gray-100 transition-colors' }
          }"
        >
          <template #thumbnail-cell="{ row }">
            <img :src="row.original.thumbnail" class="w-[100px] h-[100px] object-cover mx-auto rounded border border-gray-200" />
          </template>

          <template #title-cell="{ row }">
            <div class="flex flex-col text-left">
              <a href="#" class="font-semibold text-gray-800 underline hover:text-blue-600">{{ row.original.title }}</a>
              <span class="text-xs text-gray-500 uppercase mt-1">{{ row.original.brand || 'NO BRAND' }}</span>
            </div>
          </template>

          <template #price-cell="{ row }">
            <span class="font-medium">${{ row.original.price }}</span>
          </template>

          <template #rating-cell="{ row }">
            <span :class="row.original.rating < 4.5 ? 'text-red-500 font-bold' : 'text-green-600 font-bold'">
              {{ row.original.rating }}
            </span>
          </template>

          <template #description-cell="{ row }">
            <div class="w-48 truncate mx-auto" :title="row.original.description">{{ row.original.description }}</div>
          </template>

          <template #actions-cell="{ row }">
            <button @click="buyPlan(row.original)" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-1 px-3 rounded text-sm transition-colors">
              Buy
            </button>
          </template>

        </UTable>
      </div>

      <div class="mt-6 flex justify-between items-center text-sm text-gray-600 font-medium">
        <div>Записів знайдено: {{ filteredData.length }}</div>
        <UPagination v-model="page" :page-count="pageSize" :total="filteredData.length" />
      </div>
    </div>
  </div>
</template>
