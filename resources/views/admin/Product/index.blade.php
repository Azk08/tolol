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
    <x-nav-admin></x-nav-admin>
    <main>
        <section class="flex flex-wrap p-[100px] justify-center items-center gap-2">
            <h1 class="w-full text-4xl font-semibold text-center">Product</h1>
            <a href="{{ route('product.create') }}"
                class="w-full p-2 text-center text-white duration-1000 bg-black rounded-lg hover:bg-white hover:text-gray-500">Create</a>
            <table class="text-center border-black border-solid border-[1px] table-auto table p-[10px]">
                <thead class="table-header-group text-white bg-black">
                    <tr class="table-row p-[10px]">
                        <th class="table-cell p-[10px]">id</th>
                        <th class="table-cell p-[10px]">Name</th>
                        <th class="table-cell p-[10px]">Qty</th>
                        <th class="table-cell p-[10px]">Price</th>
                        <th class="table-cell p-[10px]">Image</th>
                        <th class="table-cell p-[10px]">Action</th>
                    </tr>
                </thead>
                <tbody class="table-row-group">
                    @foreach ($product as $row)
                        <tr class="table-row ">
                            <td class="p-[10px]">{{ $row->id }}</td>
                            <td class="p-[10px]">{{ $row->name }}</td>
                            <td class="p-[10px]">{{ $row->qty }}</td>
                            <td class="p-[10px]">{{ $row->price }}</td>
                            <td class="p-[10px]">{{ $row->image }}</td>
                            <td class="p-[100px] flex flex-wrap items-center justify-around">
                                <a href="{{ route('product.edit', $row->id) }}"
                                    class="bg-green-600 p-[5px] rounded-lg w-1/2 hover:text-white duration-700">Edit</a>
                                <form action="{{ route('product.destroy', $row->id) }}" method="POST" class="w-1/2">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Delete"
                                        class="bg-red-600 p-[5px] rounded-lg hover:text-white duration-700">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </main>
    @vite('resources/js/app.js')
</body>

</html>
