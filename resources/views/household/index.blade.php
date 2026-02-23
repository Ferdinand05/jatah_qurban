<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulir Warga</title>
    {{-- ✅ WAJIB: Ini untuk inject CSS/JS Livewire --}}
    @livewireStyles

    {{-- ✅ WAJIB: Vite/Asset untuk Tailwind --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <mai>
        <livewire:form-household />
        </main>
</body>

</html>
