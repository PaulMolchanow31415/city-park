<?php

namespace App\Http\Controllers;

use Inertia\Response;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Inertia\ResponseFactory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller {
    use ImageValidationRules;

    protected function extractCategories() {
        return MenuItem::all()->pluck('category')->unique();
    }

    public function index(): Response|ResponseFactory {
        $category = MenuItem::all()->first()->category;
        session()->reflash();

        return inertia('Rest/Menu', [
            'menuItems'  => MenuItem::where('category', $category)->get(),
            'categories' => $this->extractCategories(),
            'order'      => session('order'),
        ]);
    }

    public function show(string $categoryName): Response|ResponseFactory {
        session()->reflash();

        return inertia('Rest/Menu', [
            'menuItems'  => MenuItem::where('category', $categoryName)->get(),
            'categories' => $this->extractCategories(),
            'order'      => session('order'),
        ]);
    }

    public function adminShow(): Response|ResponseFactory {
        return inertia('Admin/Menu', [
            'menuItems'  => MenuItem::orderByDesc('id')->get(),
            'categories' => $this->extractCategories(),
        ]);
    }

    public function store(Request $request): RedirectResponse {
        $request->validate([
            'isOnlineSaleAvailable' => ['required', 'bool'],
            'name'                  => ['required', 'string'],
            'description'           => ['required', 'string', 'max:2048'],
            'price'                 => ['required', 'int'],
            'weight'                => ['required', 'int'],
            'category'              => ['required', 'string'],
            'image'                 => $this->imageRules(),
        ]);

        $input = $request->input();
        $newSrc = $request->file('image')->store('uploads/menu', 'public');
        $oldProduct = MenuItem::firstOrNew(['id' => $input['id']]);
        $oldSrc = $oldProduct->src;

        if (isset($oldSrc)) {
            Storage::disk('public')->delete($oldSrc);
        }

        MenuItem::updateOrCreate(
            ['id' => $input['id']],
            [
                'isOnlineSaleAvailable' => $input['isOnlineSaleAvailable'],
                'name'                  => $input['name'],
                'description'           => $input['description'],
                'price'                 => $input['price'],
                'weight'                => $input['weight'],
                'category'              => $input['category'],
                'src'                   => $newSrc,
            ],
        );

        return to_route('admin.menu')->with('success', 'Товар добавлен успешно!');
    }

    public function destroy(int $id): RedirectResponse {
        $menuItem = MenuItem::findOrFail($id);
        Storage::disk('public')->delete($menuItem->src);
        $menuItem->delete();

        return to_route('admin.menu')->with('success', 'Товар удален!');
    }
}
