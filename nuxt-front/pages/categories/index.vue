<script setup>
const { data: response, refresh } = await useFetch('http://127.0.0.1:8000/api/admin/blog/categories')

const columns = [
    { key: 'id', label: 'ID' },
    { key: 'title', label: 'Назва' },
    { key: 'slug', label: 'slug' },
    { key: 'actions', label: 'Дії' }
]

const items = (row) => [
    [
        {
            label: 'Редагувати',
            icon: 'i-heroicons-pencil-square-20-solid',
            to: `/categories/${row.id}/edit`
        },
        {
            label: 'Видалити',
            icon: 'i-heroicons-trash-20-solid',
            click: async () => {
                if (confirm('Точно видалити цю категорію?')) {
                    await $fetch(`http://127.0.0.1:8000/api/admin/blog/categories/${row.id}`, { method: 'DELETE' })
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
            <h1 class="text-xl font-bold">Категорії</h1>
            <UButton to="/categories/create">Додати</UButton>
        </div>

        <UTable :rows="response?.data || []" :columns="columns">
            <template #actions-data="{ row }">
                <UDropdown :items="items(row)">
                    <UButton color="gray" variant="ghost" icon="i-heroicons-ellipsis-horizontal-20-solid" />
                </UDropdown>
            </template>
        </UTable>
    </div>
</template>
