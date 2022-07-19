<script>
    function create() {
        return {
            formData: {
                name: '',
                email: '',
                phone: '',
                birthday: '',
                sex: '',
                height: '',
                weight: ''
            },

            message: "",

            submitCreate() {
                this.message = ''

                fetch('http://api.patient_site.test/api/patients', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            "Authorization": "Bearer ".concat(window.localStorage.getItem("token"))
                        },
                        body: JSON.stringify(this.formData)
                    })
                    .then((response) => response.json())
                    .then((json) => {
                        this.message = JSON.stringify(json.message)
                        /* window.location.replace('http://app.patient_site.test') */
                    })
            }
        }
    }
</script>

<x-layout>
    <x-card class="p-10 rounded max-w-lg mx-auto mt-24 mb-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Create a new patient
            </h2>
            <p class="mb-4">Add patient data</p>
        </header>

        <form method="POST" action="/patients" enctype="multipart/form-data" x-data="create()" @submit.prevent="submitCreate">
            @csrf

            {{-- uses value attribute to keep old text in case of error --}}
            <div class="mb-6">
                <label for="name" class="inline-block text-lg mb-2">Name</label>
                <input type="text" x-model="formData.name" class="border border-gray-200 rounded p-2 w-full" name="name" value="{{old('name')}}" />
            </div>

            @error('name')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <div class="mb-6">
                <label for="email" class="inline-block text-lg mb-2">Email</label>
                <input type="text" x-model="formData.email" class="border border-gray-200 rounded p-2 w-full" name="email" value="{{old('email')}}"/>
            </div>

            @error('email')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <div class="mb-6">
                <label for="phone" class="inline-block text-lg mb-2">Phone</label>
                <input type="text" x-model="formData.phone" class="border border-gray-200 rounded p-2 w-full" name="phone"
                    placeholder="555-555-5555" value="{{old('phone')}}"/>
            </div>

            @error('phone')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <div class="mb-6">
                <label for="birthday" class="inline-block text-lg mb-2">
                    Birthday
                </label>
                <input type="text" x-model="formData.birthday" class="border border-gray-200 rounded p-2 w-full" name="birthday"
                    placeholder="dd/mm/yyyy" value="{{old('birthday')}}"/>
            </div>

            @error('birthday')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <div class="mb-6">
                <label for="sex" class="inline-block text-lg mb-2">
                    Sex
                </label>
                <input type="text" x-model="formData.sex" class="border border-gray-200 rounded p-2 w-full" name="sex"
                    placeholder="M or F" value="{{old('sex')}}"/>
            </div>

            @error('sex')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <div class="mb-6">
                <label for="height" class="inline-block text-lg mb-2">
                    Height
                </label>
                <input type="text" x-model="formData.height" class="border border-gray-200 rounded p-2 w-full" name="height"
                    placeholder="ft ' in" value="{{old('height')}}"/>
            </div>

            @error('height')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <div class="mb-6">
                <label for="weight" class="inline-block text-lg mb-2">
                    Weight (lbs)
                </label>
                <input type="text" x-model="formData.weight" class="border border-gray-200 rounded p-2 w-full" name="weight"
                    placeholder="189" value="{{old('weight')}}"/>
            </div>

            @error('weight')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <div class="mb-6">
                <button type="submit" class="bg-sky-900 text-white rounded py-2 px-4 hover:bg-black">
                    Create Patient
                </button>

                <a href="/" class="text-black ml-4"> Back </a>
            </div>
            <p x-text="message"></p>
        </form>
    </x-card>
</x-layout>