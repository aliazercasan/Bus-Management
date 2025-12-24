@extends('layouts.app')

@section('title', 'Driver Details')

@section('content')
@include('layouts.admin-header')

<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('admin.dashboard') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">
                ← Back to Dashboard
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-4">
                <h1 class="text-2xl font-bold text-white">Driver Details</h1>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase">Driver ID</h3>
                        <p class="mt-1 text-lg text-gray-900">{{ $user->id }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase">Full Name</h3>
                        <p class="mt-1 text-lg text-gray-900">
                            {{ $user->driverDetail->firstname ?? 'N/A' }} {{ $user->driverDetail->lastname ?? '' }}
                        </p>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase">Age</h3>
                        <p class="mt-1 text-lg text-gray-900">{{ $user->driverDetail->age ?? 'N/A' }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase">Contact Number</h3>
                        <p class="mt-1 text-lg text-gray-900">{{ $user->driverDetail->contact_number ?? $user->contactNumber ?? 'N/A' }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase">Email</h3>
                        <p class="mt-1 text-lg text-gray-900">{{ $user->email }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase">Status</h3>
                        <p class="mt-1 text-lg">
                            <span class="px-3 py-1 rounded-full text-sm font-medium
                                {{ ($user->status ?? 'pending') === 'approved' ? 'bg-green-100 text-green-800' : '' }}
                                {{ ($user->status ?? 'pending') === 'rejected' ? 'bg-red-100 text-red-800' : '' }}
                                {{ ($user->status ?? 'pending') === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}">
                                {{ ucfirst($user->status ?? 'pending') }}
                            </span>
                        </p>
                    </div>

                    <div class="md:col-span-2">
                        <h3 class="text-sm font-semibold text-gray-500 uppercase">Address</h3>
                        <p class="mt-1 text-lg text-gray-900">{{ $user->driverDetail->address ?? 'N/A' }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase">Bus ID</h3>
                        <p class="mt-1 text-lg text-gray-900">{{ $user->busID ?? 'Not Assigned' }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase">Route</h3>
                        <p class="mt-1 text-lg text-gray-900">{{ $user->bus->route ?? 'N/A' }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase">Bus Capacity</h3>
                        <p class="mt-1 text-lg text-gray-900">{{ $user->bus->passengerCapacity ?? 'N/A' }}</p>
                    </div>

                    @if($user->driverDetail && $user->driverDetail->resume)
                    <div class="md:col-span-2">
                        <h3 class="text-sm font-semibold text-gray-500 uppercase mb-3">Submitted Resume</h3>
                        @php
                            $resumePath = $user->driverDetail->resume;
                            $extension = pathinfo($resumePath, PATHINFO_EXTENSION);
                        @endphp
                        
                        @if(in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']))
                            <!-- Image Preview -->
                            <div class="border-2 border-gray-200 rounded-lg overflow-hidden">
                                <img src="{{ asset('storage/' . $resumePath) }}" 
                                     alt="Driver Resume" 
                                     class="w-full h-auto max-h-96 object-contain bg-gray-50">
                            </div>
                            <a href="{{ asset('storage/' . $resumePath) }}" 
                               target="_blank" 
                               class="inline-flex items-center mt-3 text-indigo-600 hover:text-indigo-800 font-medium">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                                Open in New Tab
                            </a>
                        @elseif(strtolower($extension) === 'pdf')
                            <!-- PDF Preview -->
                            <div class="border-2 border-gray-200 rounded-lg overflow-hidden bg-gray-50">
                                <iframe src="{{ asset('storage/' . $resumePath) }}" 
                                        class="w-full h-96"
                                        frameborder="0">
                                </iframe>
                            </div>
                            <a href="{{ asset('storage/' . $resumePath) }}" 
                               target="_blank" 
                               class="inline-flex items-center mt-3 text-indigo-600 hover:text-indigo-800 font-medium">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Download PDF
                            </a>
                        @else
                            <!-- Other file types -->
                            <a href="{{ asset('storage/' . $resumePath) }}" 
                               target="_blank" 
                               class="inline-flex items-center px-4 py-3 bg-indigo-50 border border-indigo-200 rounded-lg hover:bg-indigo-100 transition">
                                <svg class="w-6 h-6 text-indigo-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">View Resume Document</p>
                                    <p class="text-xs text-gray-500">{{ strtoupper($extension) }} File</p>
                                </div>
                            </a>
                        @endif
                    </div>
                    @else
                    <div class="md:col-span-2">
                        <h3 class="text-sm font-semibold text-gray-500 uppercase">Resume</h3>
                        <p class="mt-1 text-gray-400 italic">No resume submitted</p>
                    </div>
                    @endif
                </div>

                @if($user->status === 'rejected')
                    <!-- Rejected Status -->
                    <div class="mt-8">
                        <div class="inline-flex items-center px-6 py-3 bg-red-100 text-red-800 rounded-lg font-medium">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            This driver has been rejected
                        </div>
                    </div>
                @elseif($user->status === 'approved')
                    <!-- Approved Status -->
                    <div class="mt-8">
                        <div class="inline-flex items-center px-6 py-3 bg-green-100 text-green-800 rounded-lg font-medium">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            This driver has been approved
                        </div>
                    </div>
                @else
                    <!-- Action Buttons for Pending -->
                    <div class="mt-8 flex gap-4">
                        <button type="button" 
                                onclick="openApproveModal({{ $user->id }})"
                                class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg transition duration-200 font-medium shadow-sm">
                            Approve Driver
                        </button>

                        <button type="button" 
                                onclick="openRejectModal({{ $user->id }})"
                                class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-lg transition duration-200 font-medium shadow-sm">
                            Reject Driver
                        </button>
                    </div>
                @endif
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
