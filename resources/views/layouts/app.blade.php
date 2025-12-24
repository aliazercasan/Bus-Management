<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'UniRide - Bus Management')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="font-sans antialiased bg-gray-50">
    @yield('content')

    <!-- Toast Notification -->
    @if (session('success'))
        <div id="toast" style="position: fixed !important; top: 24px !important; right: 24px !important; min-width: 320px; max-width: 420px; z-index: 9999 !important;" class="bg-white border-l-4 border-green-500 rounded-xl shadow-2xl overflow-hidden animate-slide-in">
            <div class="flex items-start p-4">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4 flex-1">
                    <p class="text-sm font-semibold text-gray-900">Success</p>
                    <p class="mt-1 text-sm text-gray-600">{{ session('success') }}</p>
                </div>
                <button onclick="closeToast()" class="ml-4 flex-shrink-0 text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="h-1 bg-gray-100">
                <div id="toast-progress" class="h-full bg-green-500 transition-all duration-[4000ms] ease-linear" style="width: 100%"></div>
            </div>
        </div>
        <style>
            @keyframes slide-in {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            .animate-slide-in {
                animation: slide-in 0.3s ease-out;
            }
        </style>
        <script>
            function closeToast() {
                const toast = document.getElementById('toast');
                if (toast) {
                    toast.style.transform = 'translateX(100%)';
                    toast.style.opacity = '0';
                    setTimeout(() => toast.remove(), 300);
                }
            }

            // Auto-close after 4 seconds
            setTimeout(() => {
                const progress = document.getElementById('toast-progress');
                if (progress) progress.style.width = '0%';
            }, 100);

            setTimeout(() => closeToast(), 4000);
        </script>
    @endif

    @if (session('error'))
        <div id="toast" style="position: fixed !important; top: 24px !important; right: 24px !important; min-width: 320px; max-width: 420px; z-index: 9999 !important;" class="bg-white border-l-4 border-red-500 rounded-xl shadow-2xl overflow-hidden animate-slide-in">
            <div class="flex items-start p-4">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4 flex-1">
                    <p class="text-sm font-semibold text-gray-900">Error</p>
                    <p class="mt-1 text-sm text-gray-600">{{ session('error') }}</p>
                </div>
                <button onclick="closeToast()" class="ml-4 flex-shrink-0 text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="h-1 bg-gray-100">
                <div id="toast-progress" class="h-full bg-red-500 transition-all duration-[4000ms] ease-linear" style="width: 100%"></div>
            </div>
        </div>
        <style>
            @keyframes slide-in {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            .animate-slide-in {
                animation: slide-in 0.3s ease-out;
            }
        </style>
        <script>
            function closeToast() {
                const toast = document.getElementById('toast');
                if (toast) {
                    toast.style.transform = 'translateX(100%)';
                    toast.style.opacity = '0';
                    setTimeout(() => toast.remove(), 300);
                }
            }

            // Auto-close after 4 seconds
            setTimeout(() => {
                const progress = document.getElementById('toast-progress');
                if (progress) progress.style.width = '0%';
            }, 100);

            setTimeout(() => closeToast(), 4000);
        </script>
    @endif
</body>
</html>
