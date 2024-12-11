<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contacts;
use App\Models\Products;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function admin(){
        $product = Products::all();
        $contact = Contacts::all();
        return view('admin.dashboard', compact('product', 'contact'));
    }
}
