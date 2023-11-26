<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller {
    public function index(): \Inertia\Response|\Inertia\ResponseFactory {
        return inertia('Rest/Menu');
    }

    public function store(Request $request) {
    }

    public function show(string $id): \Inertia\Response|\Inertia\ResponseFactory {
        return inertia('Rest/Menu');
    }

    public function update(Request $request, string $id) {

    }

    public function destroy(string $id) {

    }
}
