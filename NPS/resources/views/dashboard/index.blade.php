@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tableau de bord</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Statistiques</h5>
                <ul>
                    <li>Nombre total d'utilisateurs : {{ $totalUsers }}</li>
                    <li>Nombre total de commandes : {{ $totalOrders }}</li>
                    <!-- Autres statistiques -->
                </ul>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Fonctionnalités supplémentaires</h5>
                <!-- Autres éléments de fonctionnalités -->
            </div>
        </div>
    </div>
@endsection
