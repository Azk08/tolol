<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>

<body>
    <header>
        <h1 class="text-3xl font-bold text-center p-[10px]">Edit Product</h1>
    </header>
    <div class="inline-flex justify-center">
        <form action="{{ route('product.update', $product) }}" method="post"
            class="flex flex-wrap w-1/2 text-center p-[100px] justify-center gap-10 rounded-2xl">
            @csrf
            @method('PUT')
            @if ($product->image)
                <div>
                    <p>Current Image:</p>
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" width="150">
                </div>
            @endif
            <input type="text" name="name" id="name" placeholder="name" value="{{ $product->name }}"
                class="w-full rounded-xl">
            <input type="number" name="qty" id="qty" placeholder="stock" value="{{ $product->qty }}"
                class="w-full rounded-xl">
            <input type="number" name="price" id="price" placeholder="price" value="{{ $product->price }}"
                class="w-full rounded-xl">
            <input type="file" name="image" id="image" placeholder="picture">

            <input type="submit" value="Upload"
                class="w-[100%] bg-black text-white rounded-xl hover:bg-white hover:text-gray-500 duration-700">
        </form>
    </div>

    @vite('resources/js/app.js')
</body>

</html>
