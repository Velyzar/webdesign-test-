<script setup>
import { z } from 'zod'

const schema = z.object({
    title: z.string().min(5, 'Мінімум 5 символів'),
    slug: z.string().min(5, 'Мінімум 5 символів'),
    category_id: z.number().min(1, 'Вкажіть ID категорії')
})

const state = reactive({
    title: '',
    slug: '',
    category_id: 1, // Ставимо 1 як дефолтне значення, щоб не ускладнювати
    is_published: false
})

async function save() {
    try {
        await $fetch('http://127.0.0.1:8000/api/admin/blog/posts', {
            method: 'POST',
            body: state
        })
        navigateTo('/posts')
    } catch (error) {
        alert('Помилка! Можливо, такий slug вже існує.')
        console.error(error)
    }
}
</script>

<template>
    <div class="max-w-md mx-auto mt-10 p-4 border rounded shadow-sm">
        <h1 class="text-lg font-semibold mb-4">Новий пост</h1>

        <UForm :schema="schema" :state="state" class="space-y-4" @submit="save">

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
                <UCheckbox v-model="state.is_published" label="Опублікувати одразу" />
            </UFormGroup>

            <div class="flex gap-2 mt-6">
                <UButton type="submit">Зберегти</UButton>
                <UButton to="/posts" color="gray" variant="soft">Назад</UButton>
            </div>

        </UForm>
    </div>
</template>
