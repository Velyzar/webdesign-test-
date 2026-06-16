<script setup>
import { z } from 'zod'
const route = useRoute()

const { data: response } = await useFetch(`http://127.0.0.1:8000/api/admin/blog/posts/${route.params.id}`)

const schema = z.object({
    title: z.string().min(5, 'Мінімум 5 символів'),
    slug: z.string().min(5, 'Мінімум 5 символів'),
    category_id: z.number().min(1, 'Вкажіть ID категорії')
})

const state = reactive({
    title: response.value?.data?.title || '',
    slug: response.value?.data?.slug || '',
    category_id: response.value?.data?.category_id || 1,
    is_published: response.value?.data?.is_published || false
})

async function update() {
    try {
        await $fetch(`http://127.0.0.1:8000/api/admin/blog/posts/${route.params.id}`, {
            method: 'PATCH',
            body: state
        })
        navigateTo('/posts')
    } catch (error) {
        alert('Помилка оновлення!')
        console.error(error)
    }
}
</script>

<template>
    <div class="max-w-md mx-auto mt-10 p-4 border rounded shadow-sm">
        <h1 class="text-lg font-semibold mb-4">Редагування поста</h1>

        <UForm :schema="schema" :state="state" class="space-y-4" @submit="update">

            <UFormGroup label="Заголовок" name="title">
                <UInput v-model="state.title" />
            </UFormGroup>

            <UFormGroup label="Slug" name="slug">
                <UInput v-model="state.slug" />
            </UFormGroup>

            <UFormGroup label="ID Категорії" name="category_id">
                <UInput v-model="state.category_id" type="number" />
            </UFormGroup>

            <UFormGroup name="is_published">
                <UCheckbox v-model="state.is_published" label="Опублікувати" />
            </UFormGroup>

            <div class="flex gap-2 mt-6">
                <UButton type="submit">Оновити</UButton>
                <UButton to="/posts" color="gray" variant="soft">Назад</UButton>
            </div>

        </UForm>
    </div>
</template>
