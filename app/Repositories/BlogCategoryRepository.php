<?php

namespace App\Repositories;

use App\Models\BlogCategory as Model;

/**
 * Class BlogCategoryRepository.
 */
class BlogCategoryRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Отримати модель для редагування в адмінці
     * @param int $id
     * @return Model
     */
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }

    /**
     * Отримати список категорій для виводу в випадаючий список
     */
    public function getForComboBox()
    {
        // Коментуємо старий рядок: return $this->startConditions()->all();

        $columns = implode(', ', [
            'id',
            'CONCAT (id, ". ", title) AS id_title',  //додаємо поле id_title
        ]);

        $result = $this
            ->startConditions()
            ->selectRaw($columns)
            ->toBase() // оптимізація: повертаємо чисті дані stdClass замість важких моделей Eloquent
            ->get();

        return $result;
    }

    /**
     * Отримати категорію для виводу пагінатором
     * * @param int|null $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllWithPaginate($perPage = null)
    {
        $columns = ['id', 'title', 'parent_id'];

        $result = $this
            ->startConditions()
            ->select($columns)
            ->with(['parentCategory:id,title']) // Жадібне завантаження ідентифікатора та назви батька
            ->paginate($perPage);

        return $result;
    }
}
