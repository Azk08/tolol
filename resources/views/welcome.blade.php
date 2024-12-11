<!DOCTYPE html>
<html lang="en" class=" scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>

<body class="p-0 m-0 bg-black">
    <header class="text-white bg-center bg-cover p-[100px] flex flex-wrap items-center justify-around">
        <div class="w-1/2 text">
            <h1 class="font-semibold text-9xl">Welcome</h1>
            <h3 class="text-5xl ">To Our Shop</h3>
            <a
                href="#product"class=" right-[100px] bottom-[100px] hover:text-gray-500 duration-700 rounded-xl text-white p-2 ">Gets
                Started</a>
        </div>
        <img src="{{ asset('Images/logo.png') }}" alt="logo" class="w-1/2">
    </header>
    <x-nav></x-nav>
    <main>
        <section class="flex flex-wrap justify-around gap-[10px] text-white p-[100px]" id="product">
            <h1 class="w-full text-center text-8xl">Products</h1>
            @foreach ($products as $product)
                <div class="border-white rounded-md card">
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                            class="object-cover w-full h-64 rounded-md">
                    @else
                        <div class="flex items-center justify-center w-full h-64 bg-gray-700">
                            No Image
                        </div>
                    @endif
                    <h2 class="mt-2 text-xl">{{ $product->name }}</h2>
                    <p class="text-lg">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <p class="text-sm">Stok: {{ $product->qty }}</p>
                    <a href="/product" class="text-2xl font-bold text-center">More</a>
                </div>
            @endforeach
        </section>
        <section class="p-[100px] justify-center flex flex-wrap gap-[10px]">
            <h1 class="w-full text-5xl font-bold text-center text-white">Contact Us</h1>
            <form action="{{ route('contact.store') }}" method="post"
                class=" inline-grid justify-center  p-[10px] text-black gap-[10px] w-[50%] border-white border-solid border-[1px] rounded-xl">
                @csrf
                <input type="text" name="name" id="name" placeholder="Name"
                    class="rounded-md p-[10px] col-start-1 row-start-1">
                <input type="email" name="email" id="email" placeholder="E-Mail"
                    class="rounded-md p-[10px] col-start-1 row-start-2">
                <input type="number" name="number_phone" id="number_phone" placeholder="Number Phone"
                    class="rounded-md p-[10px] col-start-1 row-start-3">
                <textarea name="comment" id="comment" cols="50" rows="10" placeholder="Comment"
                    class="rounded-md p-[10px] col-start-2 row-start-1 row-end-4"></textarea>
                <button type="submit" class="text-white t">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                    </svg>
                </button>
            </form>
        </section>
    </main>
    <footer>
        <h1 class="text-2xl text-center text-white">See You Again</h1>
        <a href=""><img src="" alt=""></a>
        <a href=""><img src="" alt=""></a>
        <a href=""><img src="" alt=""></a>
        <a href=""><img src="" alt=""></a>
        <a href=""><img src="" alt=""></a>
    </footer>
    @vite('resources/js/app.js')
</body>

</html>
