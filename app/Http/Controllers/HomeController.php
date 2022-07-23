<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RolUser;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //$now = Carbon::now();
        $nowDate = Carbon::now()->setTimezone('America/Cancun')->format('d/m/Y h:i');
        return view('home',[
            'nowDate' => $nowDate,
        ]);
    }
}
