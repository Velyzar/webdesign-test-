<?php

namespace App\Http\Controllers\Api\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogPost;
// Імпортуємо ресурс чітко за Кроком 3 методички:
use App\Http\Resources\Api\Blog\Admin\PostResource;

class PostController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Робимо пагінацію через модель (оскільки властивість $blogPostRepository не оголошена в цьому класі)
        $paginator = BlogPost::with(['user', 'category'])
            ->where('is_published', 1)
            ->orderBy('id', 'desc')
            ->paginate(10); // Або paginate(25) як у ТЗ

        // ТОЧНО ЗА МЕТОДИЧКОЮ: Обгортаємо пагінацію в API Ресурс
        return PostResource::collection($paginator);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = BlogPost::with(['category', 'user'])->find($id);

        if (!$post) {
            return response()->json(
                ['message' => 'Пост не знайдено'],
                404,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }

        return response()->json($post, 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
