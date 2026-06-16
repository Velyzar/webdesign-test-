<script setup>
import { z } from 'zod'

const schema = z.object({
    title: z.string().min(3, 'Мінімум 3 символи'),
    slug: z.string().min(3, 'Мінімум 3 символи'),
    parent_id: z.number().min(1, 'Вкажіть ID') // Додали валідацію
})

const state = reactive({
    title: '',
    slug: '',
    parent_id: 1 // Додали дефолтне значення
})

async function save() {
    try {
        await $fetch('http://127.0.0.1:8000/api/admin/blog/categories', {
            method: 'POST',
            body: state
        })
        navigateTo('/categories')
    } catch (error) {
        alert('Помилка! Перевірте консоль.')
        console.error(error)
    }
}
</script>

<template>
    <div class="max-w-md mx-auto mt-10 p-4 border rounded shadow-sm">
        <h1 class="text-lg font-semibold mb-4">Нова категорія</h1>

        <UForm :schema="schema" :state="state" class="space-y-4" @submit="save">

            <UFormGroup label="Назва" name="title">
                <UInput v-model="state.title" />
            </UFormGroup>

            <UFormGroup label="Slug" name="slug">
                <UInput v-model="state.slug" />
            </UFormGroup>

            <UFormGroup label="ID Батьківської категорії" name="parent_id">
                <UInput v-model.number="state.parent_id" type="number" />
            </UFormGroup>

            <div class="flex gap-2 mt-6">
                <UButton type="submit">Зберегти</UButton>
                <UButton to="/categories" color="gray" variant="soft">Назад</UButton>
            </div>

        </UForm>
    </div>
</template>
