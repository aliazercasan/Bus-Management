@extends('layouts.app')

@section('title', 'Driver Register')

@section('content')
    <div
        class="min-h-screen flex items-center justify-center bg-gradient-to-br from-purple-600 via-purple-500 to-indigo-600 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl w-full">
            <div class="bg-white rounded-3xl shadow-2xl p-8 md:p-12">
                <!-- Header -->
                <div class="text-center mb-8">
                    <div
                        class="mx-auto h-20 w-20 bg-gradient-to-br from-purple-600 to-indigo-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h2
                        class="text-4xl font-bold bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent">
                        UniRide Driver</h2>
                    <p class="mt-3 text-gray-600">Join our community of professional drivers</p>
                </div>

                @if($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-xl mb-6">
                        <div class="flex items-start">
                            <svg class="h-6 w-6 text-red-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                            <p class="ml-3 text-sm text-red-800 font-medium">{{ $errors->first() }}</p>
                        </div>
                    </div>
                @endif

                <form action="{{ route('driver.register') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf

                    <!-- Personal Information -->
                    <div>
                        <h3 class="text-sm font-bold text-gray-900 mb-4 uppercase tracking-wide">Personal Information</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                                <input type="text" name="firstname" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition"
                                    placeholder="John">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                                <input type="text" name="lastname" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition"
                                    placeholder="Doe">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Age</label>
                                <input type="number" name="age" required min="18" max="70"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition"
                                    placeholder="25">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Contact Number</label>
                                <input type="text" name="contactNumber" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition"
                                    placeholder="+1 (234) 567-8900">
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                            <input type="text" name="address" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition"
                                placeholder="123 Main Street, City, State">
                        </div>
                    </div>

                    <!-- Documents -->
                    <div>
                        <h3 class="text-sm font-bold text-gray-900 mb-4 uppercase tracking-wide">Documents</h3>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Resume / CV (Optional)</label>
                            <input type="file" name="resume" id="resume" accept=".pdf,.jpg,.jpeg,.png" class="hidden"
                                onchange="updateFileName(this)">
                            <label for="resume"
                                class="flex items-center justify-center w-full px-6 py-8 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-purple-500 hover:bg-purple-50 transition">
                                <div class="text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                        </path>
                                    </svg>
                                    <p class="text-sm text-gray-600">
                                        <span class="font-semibold text-purple-600">Click to upload</span> or drag and drop
                                    </p>
                                    <p class="text-xs text-gray-500 mt-1">PDF, JPG, PNG up to 5MB</p>
                                </div>
                            </label>
                            <div id="file-name" class="mt-3 hidden">
                                <div
                                    class="flex items-center justify-between bg-purple-50 px-4 py-3 rounded-lg border border-purple-200">
                                    <span id="file-name-text" class="text-sm font-medium text-gray-700"></span>
                                    <button type="button" onclick="clearFile()" class="text-red-500 hover:text-red-700">
                                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Account Information -->
                    <div>
                        <h3 class="text-sm font-bold text-gray-900 mb-4 uppercase tracking-wide">Account Information</h3>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                                <input type="email" name="email" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition"
                                    placeholder="john@example.com">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                                <input type="password" name="password" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition"
                                    placeholder="••••••••">
                            </div>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-4 rounded-xl font-semibold text-lg hover:from-purple-700 hover:to-indigo-700 transform hover:scale-[1.02] active:scale-[0.98] transition shadow-lg">
                        Create Driver Account
                    </button>

                    <div class="text-center pt-4 border-t border-gray-200">
                        <p class="text-sm text-gray-600">
                            Already have an account?
                            <a href="{{ route('driver.login') }}"
                                class="font-semibold text-purple-600 hover:text-purple-700 transition">
                                Sign In →
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function updateFileName(input) {
            const fileNameDiv = document.getElementById('file-name');
            const fileNameText = document.getElementById('file-name-text');

            if (input.files && input.files[0]) {
                const file = input.files[0];
                const fileSize = (file.size / 1024 / 1024).toFixed(2);

                if (fileSize > 5) {
                    alert('⚠️ File size must be less than 5MB');
                    input.value = '';
                    fileNameDiv.classList.add('hidden');
                    return;
                }

                fileNameText.textContent = file.name + ' (' + fileSize + ' MB)';
                fileNameDiv.classList.remove('hidden');
            }
        }

        function clearFile() {
            document.getElementById('resume').value = '';
            document.getElementById('file-name').classList.add('hidden');
        }
    </script>
@endsection