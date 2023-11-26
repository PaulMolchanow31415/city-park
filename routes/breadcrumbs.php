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
Breadcrumbs ::for('rest', fn (BreadcrumbTrail $trail)
    => $trail -> parent('home') -> push('Ресторан и летнее кафе', route('rest')));

Breadcrumbs ::for('rest.restaurant', fn (BreadcrumbTrail $trail)
    => $trail -> parent('rest') -> push('Ресторан', route('rest.restaurant')));

Breadcrumbs::for('rest.cafe', fn (BreadcrumbTrail $trail)
    => $trail -> parent('rest') -> push('Летнее кафе', route('rest.cafe')));

Breadcrumbs::for('rest.news', fn (BreadcrumbTrail $trail)
    => $trail -> parent('rest') -> push('Новости и мероприятия', route('rest.news')));

Breadcrumbs::for('rest.menu', fn (BreadcrumbTrail $trail)
    => $trail -> parent('rest') -> push('Меню', route('rest.menu')));

// TODO
//Breadcrumbs::for('rest.news.show', fn(BreadcrumbTrail $trail, int $id)
//    => $trail -> parent('rest.news', ['id' => $id]) -> push("Something ".$id, route('rest.news.show')));

// Отель
Breadcrumbs::for('hotel', fn(BreadcrumbTrail $trail)
    => $trail -> parent('home') -> push('Отель-люкс', route('hotel')));

Breadcrumbs::for('hotel.catalog', fn(BreadcrumbTrail $trail)
    => $trail -> parent('catalog') -> push('Каталог номеров', route('catalog')));

