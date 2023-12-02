<?php

namespace App\Http\Controllers;

trait ImageValidationRules {
    protected function imageRules(): array {
        return ['required', 'image', 'mimes:jpg,png,jpeg,gif', 'max:65536'];
    }
}