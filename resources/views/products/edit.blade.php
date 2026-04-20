<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Barang: ') . $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('products.update', $product) }}" method="POST">
                    @csrf
                    @method('PUT') <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="name" :value="__('Nama Barang')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $product->name)" required />
                        </div>

                        <div>
                            <x-input-label for="unit_id" :value="__('Satuan (Unit)')" />
                            <select id="unit_id" name="unit_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}" {{ old('unit_id', $product->unit_id) == $unit->id ? 'selected' : '' }}>
                                        {{ $unit->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label for="base_price" :value="__('Harga Modal')" />
                            <x-text-input id="base_price" class="block mt-1 w-full" type="number" name="base_price" :value="old('base_price', $product->base_price)" required />
                        </div>

                        <div>
                            <x-input-label for="selling_price" :value="__('Harga Jual')" />
                            <x-text-input id="selling_price" class="block mt-1 w-full" type="number" name="selling_price" :value="old('selling_price', $product->selling_price)" required />
                        </div>

                        <div>
                            <x-input-label for="stock" :value="__('Stok Saat Ini')" />
                            <x-text-input id="stock" class="block mt-1 w-full" type="number" name="stock" :value="old('stock', $product->stock)" required />
                        </div>

                        <div>
                            <x-input-label for="min_stock" :value="__('Minimal Stok')" />
                            <x-text-input id="min_stock" class="block mt-1 w-full" type="number" name="min_stock" :value="old('min_stock', $product->min_stock)" required />
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <a href="{{ route('products.index') }}" class="text-gray-600 mr-4 self-center">Batal</a>
                        <x-primary-button>Update Barang</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>