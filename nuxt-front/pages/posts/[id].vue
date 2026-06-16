<template>
    <UContainer class="py-8">
        <UButton to="/BlogPostsUi" icon="i-heroicons-arrow-left" color="gray" variant="ghost" class="mb-4">
            Назад до списку
        </UButton>

        <div v-if="pending" class="flex justify-center py-12">
            <UIcon name="i-heroicons-arrow-path" class="animate-spin h-8 w-8 text-primary-500" />
        </div>

        <UAlert
            v-else-if="error"
            icon="i-heroicons-exclamation-triangle"
            color="red"
            variant="solid"
            title="Помилка завантаження"
            description="Не вдалося знайти цей пост."
        />

        <UCard v-else-if="post">
            <template #header>
                <div class="flex justify-between items-center gap-4">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ post.title }}</h1>
                    <UBadge v-if="post.category" color="primary" variant="subtle">
                        {{ post.category.title }}
                    </UBadge>
                </div>
                <div class="text-sm text-gray-500 mt-2">
                    Пост №{{ post.id }} | Автор: {{ post.user?.name || 'Адмін' }} | Дата: {{ new Date(post.created_at).toLocaleDateString() }}
                </div>
            </template>

            <div class="prose max-w-none dark:prose-invert">
                <div v-if="post.content_html" v-html="post.content_html" class="text-lg text-gray-700 dark:text-gray-300"></div>
                <p v-else class="whitespace-pre-line text-lg text-gray-700 dark:text-gray-300">
                    {{ post.content_raw || 'Вміст поста відсутній.' }}
                </p>
            </div>
        </UCard>
    </UContainer>
</template>

<script setup>
import { useRoute } from 'vue-router'

const route = useRoute()
const postId = route.params.id

// Запит до Laravel Sail на порт 8000
const { data: post, pending, error } = await useFetch(`http://127.0.0.1:8000/api/blog/posts/${postId}`)
</script>
