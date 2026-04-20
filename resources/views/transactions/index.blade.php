<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kasir Warkop') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="kasir()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col md:flex-row gap-6">

            <div class="w-full md:w-2/3 bg-white p-6 shadow-sm rounded-lg">
                <h3 class="text-lg font-bold mb-4 border-bottom">Pilih Menu</h3>
                <div class="grid grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($products as $product)
                        <div @click="addItem({{ $product->id }}, '{{ $product->name }}', {{ $product->selling_price }}, {{ $product->stock }})"
                            class="border p-4 rounded-lg cursor-pointer hover:bg-indigo-50 transition">
                            <div class="font-bold text-gray-800">{{ $product->name }}</div>
                            <div class="text-sm text-gray-500">Stok: {{ $product->stock }}</div>
                            <div class="text-indigo-600 font-bold mt-2">Rp
                                {{ number_format($product->selling_price, 0, ',', '.') }}</div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="w-full md:w-1/3 bg-white p-6 shadow-sm rounded-lg flex flex-col h-fit">
                <h3 class="text-lg font-bold mb-4">Keranjang Belanja</h3>
                @if (session('success'))
                    <div class="bg-green-500 text-white p-4 rounded mb-4">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                    <div class="bg-red-500 text-white p-4 rounded mb-4">{{ session('error') }}</div>
                @endif
                <div class="flex-grow space-y-4 mb-6">
                    <template x-for="(item, index) in cart" :key="index">
                        <div class="flex justify-between items-center border-b pb-2">
                            <div>
                                <div class="font-bold" x-text="item.name"></div>
                                <div class="text-xs text-gray-500" x-text="formatRupiah(item.price) + ' x ' + item.qty">
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <button @click="removeItem(index)" class="text-red-500 font-bold">×</button>
                            </div>
                        </div>
                    </template>
                </div>

                <div class="border-t pt-4">
                    <div class="flex justify-between text-xl font-bold mb-4">
                        <span>Total:</span>
                        <span x-text="formatRupiah(total)"></span>
                    </div>

                    <form action="{{ route('transactions.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="items" :value="JSON.stringify(cart)">
                        <input type="hidden" name="total_price" :value="total">

                        <div class="mb-4">
                            <x-input-label value="Uang Bayar" />
                            <x-text-input type="number" name="pay_amount" class="w-full" x-model="pay" required />
                        </div>

                        <div class="flex justify-between text-lg text-gray-600 mb-6">
                            <span>Kembalian:</span>
                            <span x-text="formatRupiah(pay - total)"></span>
                        </div>

                        <x-primary-button class="w-full justify-center py-3" ::disabled="cart.length === 0 || pay < total">
                            Proses Bayar
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function kasir() {
            return {
                cart: [],
                pay: 0,
                get total() {
                    return this.cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
                },
                addItem(id, name, price, stock) {
                    const found = this.cart.find(item => item.id === id);
                    if (found) {
                        if (found.qty < stock) found.qty++;
                        else alert('Stok tidak cukup!');
                    } else {
                        this.cart.push({
                            id,
                            name,
                            price,
                            qty: 1
                        });
                    }
                },
                removeItem(index) {
                    this.cart.splice(index, 1);
                },
                formatRupiah(val) {
                    return 'Rp ' + new Intl.NumberFormat('id-ID').format(val);
                }
            }
        }
    </script>
</x-app-layout>
