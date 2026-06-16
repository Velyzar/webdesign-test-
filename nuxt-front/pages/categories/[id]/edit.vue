<script setup>
import { z } from 'zod'
const route = useRoute()

const schema = z.object({
    title: z.string().min(3, 'Мінімум 3 символи'),
    slug: z.string().min(3, 'Мінімум 3 символи'),
    parent_id: z.number().min(1, 'Вкажіть ID')
})

// Форма буде спочатку порожньою, ти сам введеш нові дані
const state = reactive({
    title: '',
    slug: '',
    parent_id: 1
})

async function update() {
    try {
        await $fetch(`http://127.0.0.1:8000/api/admin/blog/categories/${route.params.id}`, {
            method: 'PUT',
            body: state
        })
        navigateTo('/categories')
    } catch (error) {
        alert('Помилка оновлення! Перевірте валідацію або консоль.')
        console.error(error)
    }
}
</script>

<template>
    <div class="max-w-md mx-auto mt-10 p-4 border rounded shadow-sm">
        <h1 class="text-lg font-semibold mb-4">Редагування категорії №{{ route.params.id }}</h1>

        <UForm :schema="schema" :state="state" class="space-y-4" @submit="update">
            <UFormGroup label="Нова назва категорії" name="title">
                <UInput v-model="state.title" placeholder="Введіть нову назву" />
            </UFormGroup>

            <UFormGroup label="Новий Slug" name="slug">
                <UInput v-model="state.slug" placeholder="новий-slug" />
            </UFormGroup>

            <UFormGroup label="ID Батьківської категорії" name="parent_id">
                <UInput v-model.number="state.parent_id" type="number" />
            </UFormGroup>

            <div class="flex gap-2 mt-6">
                <UButton type="submit">Оновити даних</UButton>
                <UButton to="/categories" color="gray" variant="soft">Назад</UButton>
            </div>
        </UForm>
    </div>
</template>
