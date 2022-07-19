<script>
    function patients() {
        return {
            patient: {},
            name: '',

            getPatient() {
                fetch('http://api.patient_site.test/api/patients', {
                        headers: {
                            "Authorization": "Bearer ".concat(window.localStorage.getItem("token"))
                        }
                    })
                    .then((response) => response.json())
                    .then((json) => this.patient = json)
                if (window.localStorage.getItem("token") === null) {
                    window.location.replace('http://app.patient_site.test/login')
                }
            }
        }
    }
</script>
<x-layout>
    {{-- @include('partials._search') --}}
    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
        <template x-data="patients()" x-init="getPatient()" x-for="p in patient">
            <div class="flex bg-gray-50 border border-gray-200 rounded p-6">
                <div class="flex space-x-20 flex-1">
                    <div class="w-1/3">
                        <h3 class="text-2xl" x-text="p.name"></h3>
                    </div>
                    <div class="w-1/3">
                        <ul>
                            <li><strong>Email:</strong>
                                <p x-text="p.email"></p>
                            </li>
                            <li><strong>Id:</strong>
                                <p x-text="p.id"></p>
                            </li>
                            <li><strong>Phone:</strong>
                                <p x-text="p.phone"></p>
                            </li>
                        </ul>
                    </div>
                    <div class="w-1/3">
                        <ul>
                            <li><strong>DOB:</strong>
                                <p x-text="p.birthday"></p>
                            </li>
                            <li><strong>Sex:</strong>
                                <p x-text="p.sex"></p>
                            </li>
                            <li><strong>Weight/Height:</strong>
                                <p x-text="p.weight + ' lbs' + '/' + p.height"></p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </template>
    </div>
</x-layout>
