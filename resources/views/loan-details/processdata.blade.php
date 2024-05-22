<!-- resources/views/your-target-view.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Records') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @elseif (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Error!</strong>
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <a href="{{ route('loan-details.index') }}" class="text-blue-500 hover:underline">Loan Details Page</a><br/><br/><br/>
                    
                    <!-- Process Data Button -->
                    <form action="{{ route('process.data') }}" method="POST">
                        @csrf
                        <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Process Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br/><br/><br/>

    @if($firstTimeProcessData == 0)
    <p>No records found.</p>
    @else
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Client ID</th>
                                @foreach($emiDetails->first() as $key => $value)
                                    <!-- Exclude 'clientid' column -->
                                    @if($key !== 'clientid')
                                        <th class="px-4 py-2">{{ $key }}</th>
                                    @endif
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($emiDetails as $detail)
                                <tr>
                                    <td class="border px-4 py-2">{{ $detail->clientid }}</td>
                                    @foreach($detail as $key => $value)
                                        <!-- Exclude 'clientid' column -->
                                        @if($key !== 'clientid')
                                            <td class="border px-4 py-2">{{ $value }}</td>
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
</x-app-layout>
