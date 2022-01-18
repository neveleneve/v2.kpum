<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class VoterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'voter']);
        
        $a = 'makanan';
        View::share([
            'a' => $a
        ]);
    }

    public function vote()
    {
        return view('vote');
    }
}
