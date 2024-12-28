<?php

namespace App\Http\Controllers\ItemCategories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ItemCategoryController extends Controller
{
    public function index()
    {
        return view('contents.admin.item-categories.index');
    }
}
