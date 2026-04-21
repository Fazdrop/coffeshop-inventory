<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan Penjualan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-sm mb-6">
                <form method="GET" action="{{ route('reports.index') }}" class="flex flex-wrap items-end gap-4">
                    <div>
                        <x-input-label value="Dari Tanggal" />
                        <x-text-input type="date" name="start_date" value="{{ $startDate }}" />
                    </div>
                    <div>
                        <x-input-label value="Sampai Tanggal" />
                        <x-text-input type="date" name="end_date" value="{{ $endDate }}" />
                    </div>
                    <x-primary-button>Filter Laporan</x-primary-button>
                    <a href="{{ route('reports.index') }}" class="text-sm text-gray-600 underline">Reset</a>
                </form>
            </div>

            <div class="bg-indigo-600 p-6 rounded-lg shadow-sm mb-6 text-white text-center">
                <p class="text-sm uppercase tracking-wider opacity-80">Total Omzet Periode Ini</p>
                <h3 class="text-3xl font-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waktu</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Item Terjual</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bayar/Kembali</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($transactions as $transaction)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{ $transaction->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                <ul class="list-disc list-inside">
                                    @foreach($transaction->details as $detail)
                                        <li>{{ $detail->product->name }} ({{ $detail->quantity }})</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="px-6 py-4 text-sm font-bold text-gray-900">
                                Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-xs text-gray-500">
                                B: {{ number_format($transaction->pay_amount, 0, ',', '.') }} <br>
                                K: {{ number_format($transaction->change_amount, 0, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-gray-500 italic">
                                Tidak ada transaksi pada periode ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>