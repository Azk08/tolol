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
    <header class="p-[100px] text-center">
        <h1 class="text-6xl font-bold">Welcome Admin</h1>
    </header>
    <x-nav-admin></x-nav-admin>
    {{-- <div
        class="fixed top-0 left-0 flex flex-col items-center w-16 h-screen py-4 text-black bg-transparent backdrop:blur-xl">
        <div class="mb-6">
            <a href="/admin/dashboard" class="block p-3 duration-700 rounded hover:bg-black hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
            </a>
        </div>
        <div class="mb-6">
            <a href="/admin/product" class="block p-3 duration-700 rounded hover:bg-black hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                </svg>
            </a>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="block p-3 duration-700 rounded hover:bg-black hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m18.75 4.5-7.5 7.5 7.5 7.5m-6-15L5.25 12l7.5 7.5" />
                </svg>
            </button>
        </form>
    </div> --}}
    <main>
        <section class="w-1/2 p-[100px]">
            <table class="text-center border-black border-solid border-[1px] table-auto table p-[10px]">
                <thead class="table-header-group text-white bg-black">
                    <tr class="table-row p-[10px]">
                        <th class="table-cell p-[10px]">id</th>
                        <th class="table-cell p-[10px]">Name</th>
                        <th class="table-cell p-[10px]">Qty</th>
                        <th class="table-cell p-[10px]">Price</th>
                        <th class="table-cell p-[10px]">Image</th>
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
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
        <section class="flex p-[100px] flex-wrap gap-10">
            @foreach ($contact as $contact)
                <div class="flex flex-wrap card p-[10px] border-[1px] rounded-2xl text-center border-black">
                    <h1 class="w-full text-2xl font-bold">{{ $contact->name }}</h1>
                    <h1 class="w-full text-xl">{{ $contact->email }}</h1>
                    <h1 class="w-full">{{ $contact->number_phone }}</h1>
                    <p class="text-justify ">{{ $contact->comment }}</p>
                </div>
            @endforeach
        </section>
    </main>

    @vite('resources/js/app.js')
</body>

</html>
