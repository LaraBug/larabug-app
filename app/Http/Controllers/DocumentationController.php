<?php

namespace App\Http\Controllers;

use App\Models\DocumentationCategory;

class DocumentationController extends Controller
{
    public function index()
    {
        return redirect()->route('docs.show', ['general', 'welcome']);

        $categories = DocumentationCategory::whereHas('items')
            ->with(['items' => function ($query) {
                return $query->orderBy('order_column', 'asc');
            }])
            ->get();

        return view('frontend.documentation.index', compact('categories'));
    }

    public function show($categorySlug, $documentationSlug)
    {
        $categories = DocumentationCategory::whereHas('items')
            ->with(['items' => function ($query) {
                return $query->orderBy('order_column', 'asc');
            }])
            ->get();

        $category = DocumentationCategory::where('slug', $categorySlug)->firstOrFail();

        $item = $category->items()->where('slug', $documentationSlug)->firstOrFail();

        return view('frontend.documentation.show', compact('categories', 'category', 'item'));
    }
}
