<?php

namespace App\Http\Controllers;

use Inertia\Response;
use App\Models\MenuItem;
use Inertia\ResponseFactory;

class RestaurantController extends Controller {
    public function index(): Response|ResponseFactory {
        return inertia('Rest/Index', [
            'menuItems' => MenuItem::orderByDesc('id')->paginate(3),
        ]);
    }

    public function summerCafe(): Response|ResponseFactory {
        return inertia('Rest/SummerCafe', [
            'menuItems' => MenuItem::orderByDesc('id')->paginate(3),
        ]);
    }

    public function restaurant(): Response|ResponseFactory {
        return inertia('Rest/Restaurant', [
            'menuItems' => MenuItem::orderByDesc('id')->paginate(3),
        ]);
    }
}
