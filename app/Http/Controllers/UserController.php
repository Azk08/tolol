<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $products = Products::all();

        return view('welcome', compact('products'));
    }
}
