<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Logique pour récupérer les données du tableau de bord
        $data = [
            'totalUsers' => User::count(),
            // 'totalOrders' => Order::count(),
            // Autres données du tableau de bord
        ];

        return view('dashboard.index', $data);
    }
}
