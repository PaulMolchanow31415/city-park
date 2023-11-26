<?php

namespace App\Http\Controllers;

use Inertia\Response;
use Illuminate\Http\Request;
use Inertia\ResponseFactory;

class NewsController extends Controller {

    public function index(): Response|ResponseFactory {
        return inertia('News/Index');
    }

    public function store(Request $request) {
    }

    public function show(int $id): Response|ResponseFactory {
        return inertia('News/NewsItem', [
            'oneNews' => [
                'title' => 'Спецпредложение в октябре',
                'datetime' => '19.10.23 10:52',
                'content' => '<p>Закажите на сайте или по телефону +79183119791</p>'
            ]
        ]);
    }

    public function update(Request $request, string $id) {
    }

    public function destroy(string $id) {
    }
}
