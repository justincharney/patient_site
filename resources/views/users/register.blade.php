<script>
    function register() {
        return {
            formData: {
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            },
            message: '',
            token: '',

            submitData() {
                this.message = ''
                this.token = ''

                fetch('http://api.patient_site.test/api/register', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(this.formData)
                    })
                    .then((response) => response.json())
                    .then((json) => this.token = json.token)
                    .then(() => {
                        this.message = 'Registered Successfully!'
                        window.localStorage.setItem("token", this.token)
                        window.location.replace('http://app.patient_site.test')
                    })
                    .catch(() => {
                        this.message = 'Ooops! Something went wrong!'
                    })
            }
        }
    }
</script>

<x-layout>
    <x-card class="p-10 max-w-lg mx-auto mt-24 mb-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Register
            </h2>
            <p class="mb-4">Create an account</p>
        </header>

        <form x-data="register()" action="/register" method="POST" @submit.prevent="submitData">
            @csrf
            <div class="mb-6">
                <label for="name" class="inline-block text-lg mb-2">
                    Name
                </label>
                <input type="text" x-model="formData.name" class="border border-gray-200 rounded p-2 w-full"
                    name="name" value="{{ old('name') }}" />

                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

            </div>

            <div class="mb-6">
                <label for="email" class="inline-block text-lg mb-2">Email</label>
                <input type="email" x-model="formData.email" class="border border-gray-200 rounded p-2 w-full"
                    name="email" value="{{ old('email') }}" />

                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="inline-block text-lg mb-2">
                    Password
                </label>
                <input type="password" x-model="formData.password" class="border border-gray-200 rounded p-2 w-full"
                    name="password" />

                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password2" class="inline-block text-lg mb-2">
                    Confirm Password
                </label>
                <input type="password" x-model="formData.password_confirmation"
                    class="border border-gray-200 rounded p-2 w-full" name="password_confirmation" />

                @error('password_confirmation')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <button type="submit" x-data="{count: $persist(0)}" x-on:click="count++" class="bg-sky-900 text-white rounded py-2 px-4 hover:bg-black">
                    Sign Up
                </button>
            </div>

            <div class="mt-8">
                <p>
                    Already have an account?
                    <a href="/login" class="text-sky-900">Login</a>
                </p>
            </div>
            <p x-text="message"></p>
            <p x-text="token"></p>
        </form>
    </x-card>
</x-layout>
