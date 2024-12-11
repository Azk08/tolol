<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <header>
        <h1>Contact</h1>
    </header>
    <main>
        <section>
            @foreach ($contact as $contact)
                <div class="card">
                    <h1>{{ $contact->name }}</h1>
                    <h1>{{ $contact->email }}</h1>
                    <h1>{{ $contact->number_phone }}</h1>
                    <p>{{ $contact->comment }}</p>
                </div>
            @endforeach
        </section>
    </main>
</body>

</html>
