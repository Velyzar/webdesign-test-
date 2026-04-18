import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useSubscriptionStore = defineStore('subscription', () => {
  const selectedPlan = ref(null)

  function setPlan(data: any) {
    selectedPlan.value = data
  }

  return { selectedPlan, setPlan }
})
