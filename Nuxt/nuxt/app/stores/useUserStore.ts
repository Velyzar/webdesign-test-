import { ref } from 'vue'
import { $fetch } from 'ofetch'
const profileData = ref(null)
const isLoading = ref(false)

async function fetchProfile() {
  isLoading.value = true
  try {
    const response = await $fetch('https://api.github.com/users/octocat')
    profileData.value = response
  } finally {
    isLoading.value = false
  }
}
