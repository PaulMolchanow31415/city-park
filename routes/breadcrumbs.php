<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Главная', route('home'));
});

Breadcrumbs::for('rest', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Ресторан и летнее кафе', route('rest'));
});

