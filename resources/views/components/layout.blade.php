<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script defer src="https://unpkg.com/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>
    {{-- added apline js --}}
    <script src="//unpkg.com/alpinejs" defer></script>
    {{-- added tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- remove flicker when reloading --}}
    <style>
        [x-cloak] {
            display: none;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Patient Site</title>
    <script>
        function logout() {
            return {
                message: '',

                submitLogout() {
                    this.message = ''

                    fetch('http://api.patient_site.test/api/logout', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                "Authorization": "Bearer ".concat(window.localStorage.getItem("token"))
                            }
                        })
                        .then(() => {
                            window.localStorage.clear()
                            this.message = 'Logged out sucessfully!'
                            window.location.replace('http://app.patient_site.test/login')
                        })
                }
            }
        }
    </script>
</head>

<body>
    <nav class="flex justify-between items-center mb-4">
        <div class="m-4 text-xl">
            <a href="/" class="hover:text-sky-900"><i class="fa-solid fa-home"></i> Home</a>
        </div>
        <ul class="flex space-x-6 mr-6 text-xl">
            {{-- <li>
                <a href="/register"><i class="fa-solid fa-user-plus"></i> Register</a>
            </li>
            <li>
                <a href="/login"><i class="fa-solid fa-arrow-right-to-bracket"></i> Login</a>
            </li> --}}
            <li>
                <a href="/create" class="inline hover:text-sky-900"><i
                        class="fa-solid fa-pencil"></i> Create</a>
            </li>
            <li>
                <form method="POST" action="/logout" class="inline hover:text-sky-900" x-data="logout()"
                    @submit.prevent="submitLogout">
                    @csrf
                    <button type="submit">
                        <i class="fa-solid fa-door-closed"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </nav>
    <div class="m-0 bg-sky-900 p-5">
        <h1 class="text-5xl text-center text-white">Patient Lookup</h1>
    </div>
    <main>
        {{ $slot }}
    </main>
</body>

</html>
