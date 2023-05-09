
<div class="w-full h-full overflow-y-auto flex justify-center p-4">
    <div class="w-[50%] h-fit p-4 rounded-lg border border-gray-300 shadow-md shadow-gray-400 bg-white ">
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 ">Full name</label>
            <input x-model="inputs.full_name" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " >
            <template x-for="error in errors.full_name" class="w-fit">
                <span x-text="error" class="text-xs text-rose-600 w-fit"></span><br>
            </template>
        </div>
        @if(in_array(session('role'), [2,3,4]))
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-900 ">Contact</label>
                <input x-model="inputs.contact_number" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " >
                <template x-for="error in errors.contact_number" class="w-fit">
                    <span x-text="error" class="text-xs text-rose-600 w-fit"></span><br>
                </template>
            </div>
        @endif
        @if(in_array(session('role'), [2,3,4]))
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
                <input x-model="inputs.email" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " >
                <template x-for="error in errors.email" class="w-fit">
                    <span x-text="error" class="text-xs text-rose-600 w-fit"></span><br>
                </template>
            </div>
        @endif
        @if(in_array(session('role'), [3,4]))
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-900 ">Company Name</label>
                <input readonly x-model="inputs.company_name" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " >
                <template x-for="error in errors.email" class="w-fit">
                    <span x-text="error" class="text-xs text-rose-600 w-fit"></span><br>
                </template>
            </div>
        @endif
        @if(in_array(session('role'), [3]))
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-900 ">Company Position</label>
                <input x-model="inputs.email" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " >
                <template x-for="error in errors.email" class="w-fit">
                    <span x-text="error" class="text-xs text-rose-600 w-fit"></span><br>
                </template>
            </div>
        @endif
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 ">Username</label>
            <input x-model="inputs.user_name" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " >
            <template x-for="error in errors.user_name" class="w-fit">
                <span x-text="error" class="text-xs text-rose-600 w-fit"></span><br>
            </template>
        </div>
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 ">Password</label>
            <div class="flex">
                <input x-model="inputs.password" x-bind:type="canSee ? 'text' : 'password'" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " >
                <button x-on:click="canSee = !canSee" class="pl-1">
                    <svg x-show="canSee" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                      </svg>
                      <svg x-show="!canSee" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                      </svg>
                </button>
            </div>
            <template x-for="error in errors.password" class="w-fit">
                <span x-text="error" class="text-xs text-rose-600 w-fit"></span><br>
            </template>
        </div>
        <button id="SubmitChangeInfo">Submit</button>
    </div>

</div>

@push('scripts')
<script>
    loadingButton({
            id:'SubmitChangeInfo',
            label: 'Update',
            onClick:'handleUpdateInfo',
            param:'isLoading',
            width:'full',
            color:'red'
    })

    document.addEventListener('alpine:init',()=>{
        Alpine.data('changeInfo',()=>({
            inputs:{
                full_name:'',
                user_name:'',
                password:'',
                email:'',
                password:'',
                company_name:'',
                company_position:'',
                contact_number:''

            },
            defaultInputs:{},
            errors:{
                full_name:[],
                user_name:[],
                password:[],
                email:[],
                password:[],
                company_name:[],
                company_position:[],
                contact_number:[]
            },
            isLoading:false,
            canSee:false,

            init(){
                this.fetchUser()
            },

            fetchUser(){
                axios.get('/fetchUser')
                .then((res)=>{
                    console.log(res.data[0])
                    for (let i in this.inputs) {
                        for (let f in res.data[0]) {
                            if(i === f && i !== 'password' ){
                                this.inputs[f] = res.data[0][f]
                            }
                        }
                    }
                    this.defaultInputs = JSON.stringify(this.inputs)
                })
            },

            handleUpdateInfo(){
                console.log(this.defaultInputs)
                if(this.defaultInputs === JSON.stringify(this.inputs))
                {
                    useToast({
                        message:'No Changes were Made',
                        type:'info'
                    })
                }
                else
                {   
                    axios.post('/updateUser', this.inputs)
                    .then((res)=>{
                        useToast({
                            message:'Successfully Updated',
                            type:'success'
                        })
                        this.fetchUser()
                    })
                    .catch((err)=>{
                        console.log(err)
                        this.errors = err.response.data.errors
                    })
                }

                
            }
        }))
    })
</script>
@endpush