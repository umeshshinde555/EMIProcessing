
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
                    @if($loanDetails->isEmpty())
                        <p>No records found.</p>
                    @else
                        <table class="table-auto w-full">
                            <thead>
                                <tr>
                                    <th class="px-2 py-2">Client ID</th>
                                    <th class="px-2 py-2">No of payment</th>
                                    <th class="px-2 py-2">First payment date</th>
                                    <th class="px-2 py-2">Last payment date</th>
                                    <th class="px-2 py-2">Loan Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($loanDetails as $record)
                                    <tr>
                                        <td class="border px-2 py-2">{{ $record->clientid }}</td>
                                        <td class="border px-2 py-2">{{ $record->num_of_payment }}</td>
                                        <td class="border px-2 py-2">{{ $record->first_payment_date }}</td>
                                        <td class="border px-2 py-2">{{ $record->last_payment_date }}</td>
                                        <td class="border px-2 py-2">{{ $record->loan_amount }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                    <a href="{{ route('process-data.index') }}" class="text-blue-500 hover:underline">Process Data Page</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
