<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Order #{{ $order->id }}</title>
    @vite('resources/css/app.css')
</head>

<body class="flex items-center justify-center min-h-screen p-4 bg-gray-100">
    <div class="w-full max-w-4xl p-6 bg-white rounded-lg shadow-lg">
        <h1 class="mb-6 text-2xl font-bold text-center">Checkout Order #{{ $order->id }}</h1>

        <div class="grid gap-6 md:grid-cols-2">
            {{-- Order Items Section --}}
            <div class="p-4 rounded-lg bg-gray-50">
                <h2 class="mb-4 text-xl font-semibold">Order Items</h2>
                @foreach ($order->orderItems as $item)
                    <div class="flex items-center justify-between py-3 border-b">
                        <div>
                            <p class="font-medium">{{ $item->product->name }}</p>
                            <p class="text-sm text-gray-600">
                                Quantity: {{ $item->quantity }}
                                × Rp {{ number_format($item->price, 0, ',', '.') }}
                            </p>
                        </div>
                        <p class="font-semibold">
                            Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}
                        </p>
                    </div>
                @endforeach
            </div>

            {{-- Shipping & Total Section --}}
            <div>
                <form action="{{ route('checkout.complete', $order->id) }}" method="POST" class="space-y-4">
                    @csrf

                    {{-- City Selection --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Origin City</label>
                        <select name="origin_city_id" required
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            {{-- Populate with cities from database --}}
                            <option value="">Select Origin City</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Destination City</label>
                        <select name="destination_city_id" required
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            {{-- Populate with cities from database --}}
                            <option value="">Select Destination City</option>
                        </select>
                    </div>

                    {{-- Courier Selection --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Shipping Courier</label>
                        <div class="mt-1 space-y-2">
                            <div class="flex items-center">
                                <input type="radio" name="courier" value="jne" id="jne"
                                    class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500" required>
                                <label for="jne" class="block ml-2 text-sm text-gray-900">JNE</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" name="courier" value="pos" id="pos"
                                    class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                <label for="pos" class="block ml-2 text-sm text-gray-900">POS Indonesia</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" name="courier" value="tiki" id="tiki"
                                    class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                <label for="tiki" class="block ml-2 text-sm text-gray-900">TIKI</label>
                            </div>
                        </div>
                    </div>

                    {{-- Order Summary --}}
                    <div class="p-4 mt-4 rounded-lg bg-gray-50">
                        <div class="flex justify-between mb-2">
                            <p class="text-gray-600">Subtotal</p>
                            <p class="font-semibold">
                                Rp {{ number_format($order->total_price - ($order->shipping_cost ?? 0), 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="flex justify-between mb-2">
                            <p class="text-gray-600">Shipping Cost</p>
                            <p class="font-semibold">
                                {{ $order->shipping_cost ? 'Rp ' . number_format($order->shipping_cost, 0, ',', '.') : 'Not calculated' }}
                            </p>
                        </div>
                        <div class="flex justify-between pt-2 font-bold border-t">
                            <p>Total</p>
                            <p>
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full py-3 text-white transition-colors bg-indigo-600 rounded-lg hover:bg-indigo-700">
                        Complete Order
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
