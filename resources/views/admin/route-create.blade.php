@extends('layouts.app')

@section('title', 'Add Route')

@section('content')
@include('layouts.admin-header')

<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <div class="mb-8">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-700 font-medium mb-4">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Dashboard
                </a>
                <h2 class="text-3xl font-bold text-gray-900">Add New Route</h2>
                <p class="mt-2 text-gray-600">Create a new bus route for the system</p>
            </div>

            @if($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded">
                    <div class="flex">
                        <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <p class="ml-3 text-sm text-red-700">{{ $errors->first() }}</p>
                    </div>
                </div>
            @endif

            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded">
                    <div class="flex">
                        <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <p class="ml-3 text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <form action="{{ route('admin.route.store') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="routeFrom" class="block text-sm font-medium text-gray-700 mb-2">Route From</label>
                    <select name="routeFrom" id="routeFrom" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200">
                        <option value="">Select starting location</option>
                        <option value="Digos City">Digos City</option>
                        <option value="Davao City">Davao City</option>
                        <option value="Bansalan">Bansalan</option>
                        <option value="Hagonoy">Hagonoy</option>
                        <option value="Kiblawan">Kiblawan</option>
                        <option value="Magsaysay">Magsaysay</option>
                        <option value="Malalag">Malalag</option>
                        <option value="Matanao">Matanao</option>
                        <option value="Padada">Padada</option>
                        <option value="Santa Cruz">Santa Cruz</option>
                        <option value="Sulop">Sulop</option>
                    </select>
                </div>

                <div>
                    <label for="routeTo" class="block text-sm font-medium text-gray-700 mb-2">Route To</label>
                    <select name="routeTo" id="routeTo" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200">
                        <option value="">Select destination</option>
                        <option value="Digos City">Digos City</option>
                        <option value="Davao City">Davao City</option>
                        <option value="Bansalan">Bansalan</option>
                        <option value="Hagonoy">Hagonoy</option>
                        <option value="Kiblawan">Kiblawan</option>
                        <option value="Magsaysay">Magsaysay</option>
                        <option value="Malalag">Malalag</option>
                        <option value="Matanao">Matanao</option>
                        <option value="Padada">Padada</option>
                        <option value="Santa Cruz">Santa Cruz</option>
                        <option value="Sulop">Sulop</option>
                    </select>
                </div>

                <div>
                    <label for="oras" class="block text-sm font-medium text-gray-700 mb-2">Departure Time</label>
                    <input type="time" name="oras" id="oras" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200">
                </div>

                <button type="submit" 
                    class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-3 rounded-lg font-semibold hover:from-indigo-700 hover:to-purple-700 transform hover:scale-[1.02] transition duration-200 shadow-lg">
                    Create Route
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
