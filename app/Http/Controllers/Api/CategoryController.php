<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends Controller
{
    /** Lista categorías e incluye cuántos ejercicios pertenecen a cada una. */
    public function index(): AnonymousResourceCollection
    {
        return CategoryResource::collection(
            Category::query()->withCount('exercises')->orderBy('name')->get(),
        );
    }

    /** Valida el nombre y crea una categoría nueva. */
    public function store(CategoryRequest $request): JsonResponse
    {
        $category = Category::query()->create($request->validated());

        return response()->json(['data' => new CategoryResource($category)], 201);
    }

    /** Presenta una categoría y su contador de ejercicios. */
    public function show(Category $category): CategoryResource
    {
        return new CategoryResource($category->loadCount('exercises'));
    }

    /** Cambia los datos de una categoría existente. */
    public function update(CategoryRequest $request, Category $category): CategoryResource
    {
        $category->update($request->validated());

        return new CategoryResource($category->loadCount('exercises'));
    }

    /** Evita borrar una categoría mientras tenga ejercicios asociados. */
    public function destroy(Category $category): JsonResponse
    {
        if ($category->exercises()->exists()) {
            return response()->json([
                'message' => 'No puedes eliminar una categoría que todavía tiene ejercicios.',
            ], 409);
        }

        $category->delete();

        return response()->json(['message' => 'Categoría eliminada.']);
    }
}
