<script setup>
import { ref } from 'vue'
import { useSubscriptionStore } from '~/stores/useSubscriptionStore'

const store = useSubscriptionStore()
const plan = store.selectedPlan

if (!plan) {
  navigateTo('/table') // якщо зайшли випадково, кидаємо назад на картки
}

const form = ref({
  cardNumber: '',
  cardExp: '',
  cardCvc: '',
  name: 'dev4 dev4',
  address: '',
  agreed: false
})

async function sendData() {
  try {
    const response = await $fetch('/api/subscription/create', {
      method: 'POST',
      body: form.value
    })
    alert(response.message)
  } catch (error) {
    alert('Помилка при відправці')
    console.error(error)
  }
}
</script>
<template>
  <div class="bg-white min-h-screen text-gray-800 pb-10">
    <Head>
      <Title>Оплата підписки</Title>
    </Head>

    <header class="bg-[#333] text-white text-center py-4 font-bold">
      Checkout
    </header>

    <main class="max-w-4xl mx-auto mt-6 px-4">
      <NuxtLink to="/" class="text-sm text-gray-500 mb-6 inline-block hover:underline">&lt;&lt; back</NuxtLink>

      <h1 class="text-2xl font-bold mb-2">You're Almost In - Start Your 3-Day Free Trial Now!</h1>
      <p class="text-gray-600 mb-8">Set up your account to gain instant access! You won't be charged if you decide to cancel within 3 days</p>

      <div class="flex flex-col md:flex-row gap-12 justify-between">

        <div class="w-full md:w-[40%]">
          <div class="border rounded shadow-sm" v-if="plan">
            <div class="h-1.5 bg-green-400"></div>
            <div class="p-5">
              <h2 class="text-xl font-bold mb-1">{{ plan.planName }}</h2>
              <span class="bg-gray-100 text-gray-500 text-[10px] px-2 py-1 rounded font-bold uppercase">3-days free then:</span>

              <div class="mt-3 mb-2">
                <span class="text-4xl font-bold">${{ plan.price.toFixed(2) }}</span>
                <span class="text-gray-500 text-sm">/month</span>
              </div>

              <p class="text-xs text-gray-500 mb-2">billed yearly at <s class="text-gray-400">${{ plan.oldPrice }}</s> ${{ plan.newPrice }}</p>
              <span class="bg-green-100 text-green-700 text-[10px] px-2 py-1 rounded font-bold">${{ plan.savings }} in savings</span>

              <ul class="mt-5 space-y-2 text-xs text-gray-600">
                <li v-for="(item, index) in plan.features" :key="index" class="flex gap-2">
                  <span class="text-green-400">✦</span>
                  <span v-html="item"></span>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <div class="w-full md:w-[55%] bg-[#fafafa] border rounded p-6">
          <h3 class="font-bold mb-4">Order Summary</h3>

          <div class="flex justify-between text-sm border-b pb-3 mb-3">
            <div>
              <p class="mb-2">Annual Plan</p>
              <p>Total Due <span class="text-[10px] text-gray-400">(*not including sales tax)</span></p>
            </div>
            <div class="text-right">
              <p class="mb-2 font-medium">${{ plan?.newPrice.toFixed(2) }}</p>
              <p class="font-medium">${{ plan?.newPrice.toFixed(2) }}</p>
            </div>
          </div>

          <div class="flex justify-between font-bold mb-6 text-sm">
            <p>Due Today</p>
            <p>$0.00</p>
          </div>

          <div class="bg-gray-200 text-center py-2 mb-6 text-sm rounded">
            Includes 3-Day Free Trial
          </div>

          <h3 class="font-bold mb-3">Billing Information</h3>

          <form @submit.prevent="sendData">
            <div class="mb-4">
              <label class="block text-xs text-gray-500 mb-1">Card Details</label>
              <div class="flex border rounded bg-white">
                <input v-model="form.cardNumber" type="text" placeholder="Number" class="p-2 w-full outline-none text-sm" required>
                <input v-model="form.cardExp" type="text" placeholder="MM / YY" class="p-2 w-20 border-l outline-none text-sm text-center" required>
                <input v-model="form.cardCvc" type="text" placeholder="CVC" class="p-2 w-16 border-l outline-none text-sm text-center" required>
              </div>
            </div>

            <div class="mb-5">
              <label class="block text-xs text-gray-500 mb-1">Address</label>
              <div class="border rounded bg-white">
                <input v-model="form.name" type="text" placeholder="Full name" class="p-2 w-full border-b outline-none text-sm" required>
                <input v-model="form.address" type="text" placeholder="Address" class="p-2 w-full outline-none text-sm" required>
              </div>
            </div>

            <div class="flex items-start gap-2 mb-6">
              <input v-model="form.agreed" type="checkbox" class="mt-1" required>
              <p class="text-[11px] text-gray-500 leading-tight">
                I consent to <b>Terms of Use</b> and understand my 3-day free trial will automatically convert to $2,490.00 per year starting on 04/02/2026. The yearly fee will be automatically charged each year going forward unless I cancel my account...
              </p>
            </div>

            <button type="submit" class="bg-gray-200 text-gray-600 py-2 px-6 rounded font-bold text-sm" :class="{'bg-[#e0e0e0] text-black': form.agreed}">
              Try It Free
            </button>
          </form>

        </div>
      </div>
    </main>
  </div>
</template>

