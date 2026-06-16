<script setup>
const { data: response, refresh } = await useFetch('http://127.0.0.1:8000/api/admin/blog/posts')

const columns = [
    { key: 'id', label: 'ID' },
    { key: 'title', label: 'Заголовок' },
    { key: 'is_published', label: 'Опубліковано' },
    { key: 'actions', label: 'Дії' }
]

const items = (row) => [
    [
        {
            label: 'Редагувати',
            icon: 'i-heroicons-pencil-square-20-solid',
            to: `/posts/${row.id}/edit`
        },
        {
            label: 'Видалити',
            icon: 'i-heroicons-trash-20-solid',
            click: async () => {
                if (confirm('Точно видалити цей пост?')) {
                    await $fetch(`http://127.0.0.1:8000/api/admin/blog/posts/${row.id}`, { method: 'DELETE' })
                    refresh()
                }
            }
        }
    ]
]
</script>

<template>
    <div class="p-4">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-xl font-bold">Пости</h1>
            <UButton to="/posts/create">Додати пост</UButton>
        </div>

        <UTable :rows="response?.data || []" :columns="columns">
            <template #is_published-data="{ row }">
        <span :class="row.is_published ? 'text-green-600' : 'text-red-600'">
          {{ row.is_published ? 'Так' : 'Ні' }}
        </span>
            </template>

            <template #actions-data="{ row }">
                <UDropdown :items="items(row)">
                    <UButton color="gray" variant="ghost" icon="i-heroicons-ellipsis-horizontal-20-solid" />
                </UDropdown>
            </template>
        </UTable>
    </div>
</template>
