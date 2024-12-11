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
    <section class="p-[100px] justify-center flex text-center flex-wrap gap-[100px]">
        <h1 class="w-full text-4xl font-semibold text-center">Upload</h1>
        <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data"
            class="flex flex-wrap justify-center gap-[50px] w-[30%] p-[10px] rounded-md border-black border-solid border-[1px]">
            @csrf
            <input type="text" name="name" id="name" placeholder="name">
            <input type="number" name="qty" id="qty" placeholder="stock">
            <input type="number" name="price" id="price" placeholder="price">
            <input type="file" name="image" id="image" placeholder="picture">
            <input type="submit" value="Upload" class="w-[100%] bg-black text-white rounded-xl hover:bg-white hover:text-gray-500 duration-700">
        </form>
    </section>

    @vite('resources/js/app.js')
</body>

</html>
