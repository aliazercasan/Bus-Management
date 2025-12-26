<nav class="bg-gradient-to-r from-indigo-600 to-purple-600 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center space-x-2">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                </svg>
                <span class="text-white text-2xl font-bold">UniRide</span>
                <span class="text-indigo-200 text-sm font-medium ml-2">Admin Portal</span>
            </div>
            <div class="flex items-center space-x-1">
                <a href="{{ route('admin.dashboard') }}" class="text-white hover:bg-white/10 px-4 py-2 rounded-lg transition duration-200 font-medium">
                    Dashboard
                </a>
                <a href="{{ route('admin.businfo.create') }}" class="text-white hover:bg-white/10 px-4 py-2 rounded-lg transition duration-200 font-medium">
                    Create Bus
                </a>
                <a href="{{ route('admin.bus.create') }}" class="text-white hover:bg-white/10 px-4 py-2 rounded-lg transition duration-200 font-medium">
                    Assign Bus
                </a>
                <a href="{{ route('admin.route.create') }}" class="text-white hover:bg-white/10 px-4 py-2 rounded-lg transition duration-200 font-medium">
                    Create Route
                </a>
                <form action="{{ route('admin.logout') }}" method="POST" class="inline ml-4">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-lg transition duration-200 font-medium shadow-md">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
