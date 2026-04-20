<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Ringkasan Warkop Huahaha</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-green-100 p-4 rounded-lg border border-green-200">
                            <p class="text-sm text-green-600 font-semibold">Saldo Kas Saat Ini</p>
                            <h2 class="text-3xl font-bold text-green-700">
                                Rp {{ number_format($currentBalance, 0, ',', '.') }}
                            </h2>
                        </div>

                        <div class="bg-red-100 p-4 rounded-lg border border-red-200">
                            <p class="text-sm text-red-600 font-semibold">Stok Perlu Restock</p>
                            <h2 class="text-3xl font-bold text-red-700">
                                {{ $lowStockCount }} <span class="text-lg">Barang</span>
                            </h2>
                        </div>

                        <div class="bg-blue-100 p-4 rounded-lg border border-blue-200">
                            <p class="text-sm text-blue-600 font-semibold">Total Penjualan Hari Ini</p>
                            <h2 class="text-3xl font-bold text-blue-700">
                                Rp {{ number_format($todaySales, 0, ',', '.') }}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
