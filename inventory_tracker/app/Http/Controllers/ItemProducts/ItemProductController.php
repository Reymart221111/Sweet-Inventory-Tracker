<?php

namespace App\Http\Controllers\ItemProducts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ItemProductController extends Controller
{
    public function index()
    {
        return view('contents.admin.item-products.index');
    }
}
