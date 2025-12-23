@extends('layouts.app')

@section('title', 'Report Route')

@section('content')
@include('layouts.driver-header')

<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <div class="mb-6">
                    <a href="{{ route('driver.dashboard') }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium mb-4">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Dashboard
                    </a>
                    <h2 class="text-3xl font-bold text-gray-900">Report Your Route</h2>
                    <p class="mt-2 text-gray-600">Submit today's route information</p>
                </div>

                @if(session('error'))
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded">
                        <div class="flex">
                            <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            <p class="ml-3 text-sm text-red-700">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif

                <form action="{{ route('driver.report.submit') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="busID" class="block text-sm font-medium text-gray-700 mb-2">Bus ID</label>
                        <input type="number" name="busID" id="busID" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                            placeholder="Enter bus ID">
                    </div>

                    <div>
                        <label for="totalPassenger" class="block text-sm font-medium text-gray-700 mb-2">Total Passengers</label>
                        <input type="text" name="totalPassenger" id="totalPassenger" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                            placeholder="Enter total passengers">
                    </div>

                    <button type="submit" 
                        class="w-full bg-gradient-to-r from-blue-600 to-cyan-600 text-white py-3 rounded-lg font-semibold hover:from-blue-700 hover:to-cyan-700 transform hover:scale-[1.02] transition duration-200 shadow-lg">
                        Submit Report
                    </button>
                </form>
            </div>

            @if(isset($bus))
            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl shadow-xl p-8 border-2 border-green-200">
                <div class="text-center mb-6">
                    <div class="mx-auto h-16 w-16 bg-gradient-to-r from-green-500 to-emerald-500 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-green-800">Submitted Successfully!</h3>
                </div>

                <div class="space-y-4">
                    <div class="bg-white rounded-lg p-4 shadow-sm">
                        <p class="text-sm text-gray-600 font-medium">Route From</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $bus->routeInfo->routeFrom }}</p>
                    </div>

                    <div class="bg-white rounded-lg p-4 shadow-sm">
                        <p class="text-sm text-gray-600 font-medium">Route To</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $bus->routeInfo->routeTo }}</p>
                    </div>

                    <div class="bg-white rounded-lg p-4 shadow-sm">
                        <p class="text-sm text-gray-600 font-medium">Total Passengers</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $totalPassenger }}</p>
                    </div>

                    <div class="bg-white rounded-lg p-4 shadow-sm">
                        <p class="text-sm text-gray-600 font-medium">Passenger Capacity</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $bus->passengerCapacity }}</p>
                    </div>

                    <div class="bg-white rounded-lg p-4 shadow-sm">
                        <p class="text-sm text-gray-600 font-medium">Route Time Date</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $bus->routeTimeDate }}</p>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
