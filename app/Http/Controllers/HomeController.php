<?php

namespace App\Http\Controllers;

use App\Models\ServiceOrder;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::all();

        return Inertia::render('Welcome', [
            'users' => $users
        ]);
    }

    public function registerService(Request $request)
    {
        // dd($request);
        $price = str_replace('.', '', $request->input('price'));
        $price = str_replace(',', '.', $price);
        ServiceOrder::create([
            'user_id' => $request->input('user_id'),
            'vehicle_plate' => $request->input('vehicle_plate'),
            'entry_date_time' => $request->input('entry_date_time') ?: now(),
            'exit_date_time' => $request->input('exit_date_time'),
            'price_type' => $request->input('price_type'),
            'price' => $price,
        ]);
    }

    public function registerUser(Request $request)
    {
        User::create([
            'name' => $request->input('name')
        ]);
    }
}
