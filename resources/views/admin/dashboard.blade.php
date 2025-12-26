@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
@include('layouts.admin-header')

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-8">
    <div class="max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-10">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                        Driver Management
                    </h1>
                    <p class="mt-2 text-gray-600 text-lg">Manage driver assignments, schedules, and approvals</p>
                </div>
                <div class="hidden md:flex items-center gap-4">
                    <div class="bg-white px-6 py-3 rounded-xl shadow-sm border border-gray-100">
                        <div class="text-sm text-gray-500">Total Drivers</div>
                        <div class="text-2xl font-bold text-gray-900">{{ $users->count() }}</div>
                    </div>
                    <div class="bg-white px-6 py-3 rounded-xl shadow-sm border border-gray-100">
                        <div class="text-sm text-gray-500">Pending</div>
                        <div class="text-2xl font-bold text-yellow-600">{{ $users->where('status', 'pending')->count() }}</div>
                    </div>
                    <div class="bg-white px-6 py-3 rounded-xl shadow-sm border border-gray-100">
                        <div class="text-sm text-gray-500">Approved</div>
                        <div class="text-2xl font-bold text-green-600">{{ $users->where('status', 'approved')->count() }}</div>
                    </div>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 p-4 rounded-xl shadow-sm animate-fade-in">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <p class="ml-3 text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Modern Table Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <!-- Table Header with Filters -->
            <div class="bg-gradient-to-r from-slate-50 to-gray-50 px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900">Driver List</h2>
                    <div class="flex items-center gap-3">
                        <button class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                            </svg>
                            Filter
                        </button>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-600">
                            <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">ID</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Driver Name</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Contact Info</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Bus Assignment</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Route</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Capacity</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($users as $user)
                        <tr class="hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-200">
                            <!-- ID -->
                            <td class="px-6 py-5 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center">
                                        <span class="text-white font-bold text-sm">{{ $user->id }}</span>
                                    </div>
                                </div>
                            </td>

                            <!-- Driver Name -->
                            <td class="px-6 py-5">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-12 w-12 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-full flex items-center justify-center">
                                        <span class="text-white font-bold text-lg">
                                            {{ strtoupper(substr($user->driverDetail->firstname ?? 'N', 0, 1)) }}{{ strtoupper(substr($user->driverDetail->lastname ?? 'A', 0, 1)) }}
                                        </span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-semibold text-gray-900">
                                            {{ $user->driverDetail->firstname ?? '' }} {{ $user->driverDetail->lastname ?? '' }}
                                        </div>
                                        <div class="text-xs text-gray-500">Age: {{ $user->driverDetail->age ?? 'N/A' }}</div>
                                    </div>
                                </div>
                            </td>

                            <!-- Contact Info -->
                            <td class="px-6 py-5">
                                <div class="space-y-1">
                                    <div class="flex items-center text-sm text-gray-900">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                        {{ $user->driverDetail->contact_number ?? $user->contactNumber ?? 'N/A' }}
                                    </div>
                                    <div class="flex items-center text-xs text-gray-500 truncate max-w-xs">
                                        <svg class="w-3 h-3 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                        </svg>
                                        {{ $user->driverDetail->address ?? 'N/A' }}
                                    </div>
                                </div>
                            </td>

                            <!-- Bus Assignment -->
                            <td class="px-6 py-5">
                                @if($user->bus && $user->bus->busInfo)
                                    <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-lg p-3 border border-indigo-100">
                                        <div class="font-semibold text-indigo-900 text-sm">{{ $user->bus->busInfo->busName }}</div>
                                        <div class="text-xs text-gray-600 mt-1 space-y-0.5">
                                            <div>ID: <span class="font-medium text-indigo-600">{{ $user->busID }}</span></div>
                                            <div>Engine: <span class="font-medium">{{ $user->bus->busInfo->engineNumber }}</span></div>
                                        </div>
                                    </div>
                                @elseif($user->busID)
                                    <span class="text-sm text-gray-600">Bus #{{ $user->busID }}</span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-500">
                                        Not Assigned
                                    </span>
                                @endif
                            </td>

                            <!-- Route -->
                            <td class="px-6 py-5">
                                @if($user->bus && $user->bus->routeInfo)
                                    <div class="flex items-center gap-2 bg-blue-50 rounded-lg p-2 border border-blue-100">
                                        <span class="text-sm font-medium text-blue-900">{{ $user->bus->routeInfo->routeFrom }}</span>
                                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                        </svg>
                                        <span class="text-sm font-medium text-blue-900">{{ $user->bus->routeInfo->routeTo }}</span>
                                    </div>
                                @else
                                    <span class="text-xs text-gray-400">No Route</span>
                                @endif
                            </td>

                            <!-- Capacity -->
                            <td class="px-6 py-5 whitespace-nowrap">
                                @if($user->bus && $user->bus->passengerCapacity)
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                        <span class="text-sm font-semibold text-gray-900">{{ $user->bus->passengerCapacity }}</span>
                                    </div>
                                @else
                                    <span class="text-xs text-gray-400">N/A</span>
                                @endif
                            </td>

                            <!-- Status -->
                            <td class="px-6 py-5 whitespace-nowrap">
                                @if($user->status === 'rejected')
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-red-100 text-red-800 border border-red-200">
                                        <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                        Rejected
                                    </span>
                                @elseif($user->status === 'approved')
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-green-100 text-green-800 border border-green-200">
                                        <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Approved
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800 border border-yellow-200">
                                        <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Pending
                                    </span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-5 whitespace-nowrap text-center">
                                <a href="{{ route('admin.driver.view', $user->id) }}" 
                                   class="inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-lg transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 font-medium text-sm">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    View Details
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                    </svg>
                                    <p class="text-gray-500 text-lg font-medium">No drivers found</p>
                                    <p class="text-gray-400 text-sm mt-1">Start by adding new drivers to the system</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Approve Modal -->
<div id="approveModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full transform transition-all">
        <div class="bg-gradient-to-r from-green-600 to-green-500 px-6 py-4 rounded-t-2xl">
            <h3 class="text-xl font-bold text-white">Approve Driver</h3>
        </div>
        
        <form id="approveForm" method="POST" action="">
            @csrf
            <div class="p-6">
                <div class="flex items-center justify-center mb-4">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                </div>
                
                <p class="text-center text-gray-700 text-lg font-medium mb-2">Approve this driver?</p>
                <p class="text-center text-gray-600 mb-6">This driver will be granted access to the system.</p>
                
                <div class="flex gap-3">
                    <button type="button" 
                            onclick="closeApproveModal()"
                            class="flex-1 px-4 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg font-medium transition">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="flex-1 px-4 py-3 bg-green-500 hover:bg-green-600 text-white rounded-lg font-medium transition">
                        Approve
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full transform transition-all">
        <div class="bg-gradient-to-r from-red-600 to-red-500 px-6 py-4 rounded-t-2xl">
            <h3 class="text-xl font-bold text-white">Reject Driver</h3>
        </div>
        
        <form id="rejectForm" method="POST" action="">
            @csrf
            <div class="p-6">
                <p class="text-gray-600 mb-4">Please provide a reason for rejecting this driver application:</p>
                
                <textarea name="rejection_reason" 
                          id="rejection_reason"
                          rows="4" 
                          required
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition resize-none"
                          placeholder="Enter rejection reason..."></textarea>
                
                <div class="flex gap-3 mt-6">
                    <button type="button" 
                            onclick="closeRejectModal()"
                            class="flex-1 px-4 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg font-medium transition">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="flex-1 px-4 py-3 bg-red-500 hover:bg-red-600 text-white rounded-lg font-medium transition">
                        Reject Driver
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function openApproveModal(userId) {
        const modal = document.getElementById('approveModal');
        const form = document.getElementById('approveForm');
        form.action = `/admin/driver/approve/${userId}`;
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeApproveModal() {
        const modal = document.getElementById('approveModal');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function openRejectModal(userId) {
        const modal = document.getElementById('rejectModal');
        const form = document.getElementById('rejectForm');
        form.action = `/admin/driver/reject/${userId}`;
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeRejectModal() {
        const modal = document.getElementById('rejectModal');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
        document.getElementById('rejection_reason').value = '';
    }

    // Close modals when clicking outside
    document.getElementById('approveModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeApproveModal();
        }
    });

    document.getElementById('rejectModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeRejectModal();
        }
    });

    // Close modals on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeApproveModal();
            closeRejectModal();
        }
    });
</script>
@endsection
