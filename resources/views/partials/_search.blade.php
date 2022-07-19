<script>
    function search() {
        return {
            formData: {
                email: '',
                password: ''
            },
            message: '',
            token: '',

            submitLogin() {
                this.message = ''
                this.token = ''

                fetch('http://api.patient_site.test/api/login', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(this.formData)
                    })
                    .then((response) => response.json())
                    .then((json) => {
                        this.token = json.token
                        this.message = json.message
                        if(this.token != null){
                            window.sessionStorage.setItem("token", this.token)
                            window.location.replace('http://app.patient_site.test')
                        }
                    })
            }
        }
    }
</script>

<form action="">
    <div class="relative border-gray-100 border-2 m-4 rounded-lg">
        <div class="absolute top-4 left-3">
            <i
                class="fa fa-search text-gray-400 z-20"
            ></i>
        </div>
        <input
            type="text"
            name="search"
            class="h-14 w-full pl-10 pr-20 rounded-lg z-0 focus:shadow focus:outline-none"
            placeholder="Search Patient Names..."
        />
        <div class="absolute top-2 right-2">
            <button
                type="submit"
                class="h-10 w-20 text-white rounded-lg bg-red-500 hover:bg-red-600"
            >
                Search
            </button>
        </div>
    </div>
</form>