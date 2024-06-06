<div class="bg-white overflow-hidden shadow rounded-lg p-4">
    <div class="flex flex-row gap-4 items-center">
        <div class="avatar rounded-full bg-black w-10 h-10 flex">
            <p class="text-white font-bold text-2xl m-auto">{{ Auth::user()->name[0] }}</p>
        </div>
        <div class="flex flex-col">
            <p class="text-xl font-bold">Welcome, {{ Auth::user()->name }}</p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                this.closest('form').submit();"
                    class="text-sm text-gray-500">
                    {{ __('Sign Out') }}
                </a>
            </form>
        </div>
    </div>
</div>