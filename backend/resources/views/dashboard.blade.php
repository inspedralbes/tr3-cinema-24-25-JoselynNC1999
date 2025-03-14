@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Card per al títol -->
    <div class="mb-8">
        <div class="card bg-white shadow-lg rounded-lg">
            <div class="card-body text-center">
                <h1 class="text-4xl font-extrabold text-gray-800 mb-4">Gestió del Cinema</h1>
                <p class="text-lg text-gray-500">Selecciona una secció per administrar</p>
            </div>
        </div>
    </div>

    <!-- Cards de components -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- Usuaris -->
        <div class="col-span-1">
            <a href="{{ route('users.index') }}">
                <div class="card h-full bg-gray-100 hover:bg-gray-200 transition duration-300 ease-in-out rounded-lg shadow-md">
                    <div class="card-body text-center p-6">
                        <i class="fas fa-users fa-3x text-primary mb-4"></i>
                        <h5 class="text-xl font-semibold text-gray-800">Usuaris</h5>
                        <p class="text-gray-600">Gestiona els usuaris registrats al sistema</p>
                    </div>
                </div>
            </a>
        </div>


        <!-- Pel·lícules -->
        <div class="col-span-1">
        <a href="{{ route('movies.index') }}" class="block">
                <div class="card h-full bg-gray-100 hover:bg-gray-200 transition duration-300 ease-in-out rounded-lg shadow-md">
                    <div class="card-body text-center p-6">
                        <i class="fas fa-film fa-3x text-primary mb-4"></i>
                        <h5 class="text-xl font-semibold text-gray-800">Pel·lícules</h5>
                        <p class="text-gray-600">Gestiona les pel·lícules disponibles per a la projecció</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Sessions -->
        <div class="col-span-1">
                <div class="card h-full bg-gray-100 hover:bg-gray-200 transition duration-300 ease-in-out rounded-lg shadow-md">
                    <div class="card-body text-center p-6">
                        <i class="fas fa-calendar-day fa-3x text-primary mb-4"></i>
                        <h5 class="text-xl font-semibold text-gray-800">Sessions</h5>
                        <p class="text-gray-600">Gestiona les sessions de les pel·lícules</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Entrades -->
        <div class="col-span-1">
                <div class="card h-full bg-gray-100 hover:bg-gray-200 transition duration-300 ease-in-out rounded-lg shadow-md">
                    <div class="card-body text-center p-6">
                        <i class="fas fa-ticket-alt fa-3x text-primary mb-4"></i>
                        <h5 class="text-xl font-semibold text-gray-800">Entrades</h5>
                        <p class="text-gray-600">Gestiona les entrades venudes i disponibles</p>
                    </div>
                </div>
            </a>
        </div>

    



    </div>
</div>
@endsection
