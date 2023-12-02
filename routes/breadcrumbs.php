<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// BREADCRUMBS
// Домашняя страница
Breadcrumbs ::for('home', fn (BreadcrumbTrail $trail)
    => $trail -> push('Главная', route('home')));

Breadcrumbs::for('feedback', fn(BreadcrumbTrail $trail)
    => $trail -> parent('home') -> push('Обратная связь', route('feedback')));

Breadcrumbs::for('contacts', fn(BreadcrumbTrail $trail)
    => $trail -> parent('home') -> push('Контактная информация', route('contacts')));

// Ресторан
Breadcrumbs ::for('rest.index', fn (BreadcrumbTrail $trail)
    => $trail -> parent('home') -> push('Ресторан и летнее кафе', route('rest.index')));

Breadcrumbs ::for('rest.restaurant', fn (BreadcrumbTrail $trail)
    => $trail -> parent('rest.index') -> push('Ресторан', route('rest.restaurant')));

Breadcrumbs::for('rest.cafe', fn (BreadcrumbTrail $trail)
    => $trail -> parent('rest.index') -> push('Летнее кафе', route('rest.cafe')));

Breadcrumbs::for('rest.news.index', fn (BreadcrumbTrail $trail)
    => $trail -> parent('rest.index') -> push('Новости и мероприятия', route('rest.news.index')));

Breadcrumbs::for('rest.menu.index', fn (BreadcrumbTrail $trail)
    => $trail -> parent('rest.index') -> push('Меню', route('rest.menu.index')));

Breadcrumbs::for('rest.menu.show-by-category', function (BreadcrumbTrail $trail, string $name) {
    $trail -> parent('rest.menu.index')
        -> push($name, route('rest.menu.show-by-category', ['name' => $name]));
    return $trail;
});

Breadcrumbs::for('rest.news.show', function(BreadcrumbTrail $trail, int $id) {
    $title = \App\Models\News::find($id)->title;
    $trail -> parent('rest.news.index', ['id' => $id])
        -> push($title, route('rest.news.index'));
    return $trail;
});


// Отель
Breadcrumbs::for('hotel', fn(BreadcrumbTrail $trail)
    => $trail -> parent('home') -> push('Отель-люкс', route('hotel')));

Breadcrumbs::for('hotel.catalog', fn(BreadcrumbTrail $trail)
    => $trail -> parent('catalog') -> push('Каталог номеров', route('catalog')));

