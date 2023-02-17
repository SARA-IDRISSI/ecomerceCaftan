<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class newCategoryController extends Controller
{
    public function newCategory()
    {
        return view("admin.newCategory");
    }
}
