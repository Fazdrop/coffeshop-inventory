<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Barang Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('products.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="name" :value="__('Nama Barang')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required
                                placeholder="Contoh: Kopi Kapal Api" />
                        </div>

                        <div>
                            <x-input-label for="unit_id" :value="__('Satuan (Unit)')" />
                            <select id="unit_id" name="unit_id"
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">-- Pilih Unit --</option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}"
                                        {{ old('unit_id') == $unit->id ? 'selected' : '' }}>
                                        {{ $unit->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('unit_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="base_price" :value="__('Harga Modal (Beli)')" />
                            <x-text-input id="base_price" class="block mt-1 w-full" type="number" name="base_price"
                                required />
                        </div>

                        <div>
                            <x-input-label for="selling_price" :value="__('Harga Jual')" />
                            <x-text-input id="selling_price" class="block mt-1 w-full" type="number"
                                name="selling_price" required />
                        </div>

                        <div>
                            <x-input-label for="stock" :value="__('Stok Awal')" />
                            <x-text-input id="stock" class="block mt-1 w-full" type="number" name="stock"
                                required />
                        </div>

                        <div>
                            <x-input-label for="min_stock" :value="__('Minimal Stok (Untuk Peringatan)')" />
                            <x-text-input id="min_stock" class="block mt-1 w-full" type="number" name="min_stock"
                                required value="5" />
                        </div>
                    </div>

                    <div class="mt-6 flex items-center justify-end">
                        <a href="{{ route('products.index') }}" class="text-gray-600 mr-4">Batal</a>
                        <x-primary-button>
                            {{ __('Simpan Barang') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
