<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                    <br/>
                    <a href="{{ route('loan-details.index') }}" class="text-blue-500 hover:underline">Loan Details Page</a><br/>
                    <a href="{{ route('process-data.index') }}" class="text-blue-500 hover:underline">Process Data Page</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
