<?php

namespace App\Http\Controllers;

use Inertia\Response;
use App\Models\FeedbackItem;
use Illuminate\Http\Request;
use Inertia\ResponseFactory;
use Illuminate\Http\RedirectResponse;

class FeedbackItemController extends Controller {
    public function index(): Response|ResponseFactory {
        return inertia('Feedback');
    }

    public function store(Request $request): RedirectResponse {
        $request->validate([
            'email'   => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:4096'],
        ]);

        $input = $request->input();

        FeedbackItem::create([
            'name'    => $input['name'],
            'email'   => $input['email'],
            'theme'   => $input['theme'],
            'message' => $input['message'],
        ]);

        return to_route('home')->with('success', 'Оратная заявка отправлена!');
    }

    public function adminShow(): Response|ResponseFactory {
        return inertia('Admin/Feedback', [
            'feedbackItems' => FeedbackItem::all(),
        ]);
    }

    public function changeReadStatus(Request $request): RedirectResponse {
        $request->validate([
            'id' => ['required', 'int'],
            'isRead' => ['required', 'bool']
        ]);
        $input = $request->input();
        $feed = FeedbackItem::findOrFail($input['id']);
        $feed->isRead = $input['isRead'];
        $feed->save();

        return to_route('admin.feedback.list');
    }

    public function destroy(int $id): RedirectResponse {
        FeedbackItem::destroy($id);

        return to_route('admin.feedback.list');
    }
}
