<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Stok Barang Warkop') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between mb-4">
                    <h3 class="text-lg font-medium">Daftar Inventaris</h3>
                    <a href="{{ route('products.create') }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        + Tambah Barang
                    </a>
                </div>
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                        role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Barang</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Stok</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Harga Modal</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Harga Jual</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($products as $product)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $product->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="{{ $product->stock < $product->min_stock ? 'text-red-600 font-bold' : '' }}">
                                        {{ $product->stock }} {{ $product->unit->name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">Rp
                                    {{ number_format($product->base_price, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">Rp
                                    {{ number_format($product->selling_price, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap flex space-x-2">
                                    <a href="{{ route('products.edit', $product) }}"
                                        class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus barang ini? Semua data terkait barang ini akan hilang.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                            Hapus
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
