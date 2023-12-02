<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\News;
use Inertia\Response;
use Illuminate\Http\Request;
use Inertia\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller {
    use ImageValidationRules;

    public function index(): Response|ResponseFactory {
        return inertia('News/Index', [
            'news' => News::orderByDesc('datetime')->paginate(5),
        ]);
    }

    public function all(): JsonResponse {
        return response()->json(['news' => News::orderByDesc('datetime')->get()]);
    }

    public function show(int $id): Response|ResponseFactory {
        return inertia('News/NewsItem', [
            'oneNews' => News::findOrFail($id),
            'news'    => News::orderByDesc('datetime')->paginate(3),
        ]);
    }

    public function adminShow(): Response|ResponseFactory {
        return inertia('Admin/News', ['news' => News::orderByDesc('id')->get()]);
    }

    public function store(Request $request): RedirectResponse {
        $request->validate([
            'title'    => ['required', 'string'],
            'content'  => ['required', 'string', 'max:2048'],
            'datetime' => ['required'],
            'image'    => $this->imageRules(),
        ]);

        $input = $request->input();
        $newPath = $request->file('image')->store('uploads', 'public');
        $datetime = Carbon::parse($input['datetime'])->format('Y-m-d H:i:s');
        $oldNews = News::firstOrNew(['id' => $input['id']]);
        $oldPhotoPath = $oldNews->photo_path;

        if (isset($oldPhotoPath)) {
            Storage::disk('public')->delete($oldPhotoPath);
        }
        News::updateOrCreate(
            ['id' => $input['id']],
            [
                'title'      => $input['title'],
                'datetime'   => $datetime,
                'content'    => $input['content'],
                'photo_path' => $newPath,
            ],
        );
        return to_route('admin.index')->with('success', 'Сохранение прошло удачно!');
    }

    public function destroy(int $id): RedirectResponse {
        $news = News::findOrFail($id);
        Storage::disk('public')->delete($news->photo_path);
        $news->delete();
        session()->flash('success', 'Удаление прошло удачно!');
        return to_route('admin.index');
    }
}
