<?php

namespace App\Http\Controllers;

use App;
use App\Models\User;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function filter_gender($gender)
    {
        $user = User::where('users.gender', $gender)
            ->where('id', '!=', auth()->user()->id)
            ->where('users.is_visible', 1)
            ->select('*')->get();

        return view('home', compact('user'));
    }
}
