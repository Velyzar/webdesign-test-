<template>
  <div class="min-h-screen bg-gray-50 text-gray-900">
    <nav class="bg-gray-800 text-white p-4 flex gap-8 justify-center text-lg font-bold shadow-md">
      <NuxtLink to="/" class="hover:text-orange-400 transition-colors" active-class="text-orange-400">
         Картки
      </NuxtLink>
      <NuxtLink to="/table" class="hover:text-orange-400 transition-colors" active-class="text-orange-400">
         Таблиця
      </NuxtLink>
      <NuxtLink to="/checkout" class="hover:text-orange-400 transition-colors" active-class="text-orange-400">
        // додав як вкладку
        Оплата
      </NuxtLink>
    </nav>

    <NuxtPage />
  </div>
</template>
