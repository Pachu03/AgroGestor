<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class createUserController extends Controller
{
    public function getIndex(){
        return view("admin.createUser");
    }
}
