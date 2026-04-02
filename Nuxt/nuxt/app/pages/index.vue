<template>
  <div class="p-10 bg-gray-100 min-h-screen">
    <Head>
      <Title>Список продуктів</Title>
    </Head>

    <h1 class="text-3xl font-bold text-center mb-10">Наші Тарифи (Лаб 4)</h1>

    <div class="flex flex-wrap justify-center gap-8">
      <div v-for="(p, index) in limitedProducts" :key="p.id"
           class="bg-white shadow-xl rounded-2xl w-80 overflow-hidden border border-gray-300">

        <div :class="['h-3 w-full', index === 0 ? 'bg-blue-400' : index === 1 ? 'bg-green-400' : 'bg-teal-400']"></div>

        <div class="p-6">
          <h2 class="text-2xl font-bold mb-1">{{ p.title }}</h2>
          <p class="text-gray-400 text-xs mb-4 uppercase font-bold tracking-widest">3-days free then:</p>

          <div class="flex items-baseline gap-1 mb-4">
            <span class="text-5xl font-black">${{ p.price }}</span>
            <span class="text-gray-500 font-medium">/mo</span>
          </div>

          <div class="bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full mb-6 inline-block">
            $189 IN SAVINGS
          </div>

          <button class="w-full bg-orange-500 text-white font-black py-4 rounded-xl hover:bg-orange-600 transition-all mb-8 shadow-md">
            Try It Free
          </button>

          <ul class="text-sm text-gray-700 space-y-4">
            <li class="flex items-center gap-2"><span class="text-green-500">✦</span> <b>Brand:</b> {{ p.brand }}</li>
            <li class="flex items-center gap-2"><span class="text-green-500">✦</span> <b>Category:</b> {{ p.category }}</li>
            <li class="flex items-start gap-2">
              <span class="text-green-500">✦</span>
              <span>{{ p.description.slice(0, 70) }}...</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
// Отримуємо дані з нашого серверного API
const { data } = await useFetch('/api/products')
// Вибираємо тільки 3 штуки для красивої сітки
const limitedProducts = computed(() => data.value?.products.slice(0, 3) || [])
</script>
