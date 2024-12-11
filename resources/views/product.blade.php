<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>

<body class="text-white bg-black">
    <header class="p-[100px]">
        <h1 class="text-5xl font-bold text-center">Welcome To Product</h1>
    </header>
    <x-nav></x-nav>
    <main>
        <section class="flex flex-wrap p-[100px]">
            @foreach ($product as $product)
                <div class="card border-[1px] border-white p-[10px] rounded-2xl gap-[10px] inline-flex flex-wrap">
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                            class="object-cover w-full h-64 rounded-md">
                    @else
                        <div class="flex items-center justify-center w-full h-64 bg-gray-700">
                            No Image
                        </div>
                    @endif
                    <h2 class="w-full mt-2 text-2xl font-bold ">{{ $product->name }}</h2>
                    <p class="w-full text-lg">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <p class="w-full text-sm">Stok: {{ $product->qty }}</p>
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="mb-2">
                            <input type="number" name="quantity" value="1" min="1"
                                max="{{ $product->qty }}" class="w-full px-2 py-1 text-center text-black border rounded-md">
                        </div>
                        <button type="submit" {{ $product->qty == 0 ? 'disabled' : '' }}
                            class="w-full py-2 text-white transition duration-300 bg-blue-500 rounded-md hover:bg-blue-600 disabled:bg-gray-400 disabled:cursor-not-allowed">
                            Tambah ke Keranjang
                        </button>
                    </form>
                    <form action="{{ route('buy.now') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="mb-2">
                            <input type="number" name="quantity" value="1" min="1"
                                max="{{ $product->qty }}" class="w-full p-1 px-2 py-1 text-center text-black border rounded-md">
                        </div>
                        <button type="submit" {{ $product->qty == 0 ? 'disabled' : '' }}
                            class="w-full p-1 py-2 text-white transition duration-300 bg-green-500 rounded-md hover:bg-green-600 disabled:bg-gray-400 disabled:cursor-not-allowed">
                            Beli Sekarang
                        </button>
                    </form>
                </div>
            @endforeach
        </section>
    </main>
    @vite('resources/js/app.js')
</body>

</html>
