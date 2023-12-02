<?php

namespace App\Http\Controllers;

use App\Models\News;
use Inertia\Response;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Inertia\ResponseFactory;

class HomeController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index(): Response|ResponseFactory {
        return inertia('Home', [
            'news' => News::orderByDesc('datetime')->paginate(3),
            'menuItems' => MenuItem::orderByDesc('id')->paginate(3)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        //
    }
}
