<!DOCTYPE html>
<html lang="en">
@include('/components/head')
<title>Login</title>
<body  x-data="data" >
    <main class="w-full h-screen bg-[url('{{asset('/assets/login-bg.jpg')}}')] bg-cover bg-no-repeat text-gray-700">
        <div class="w-full h-full flex flex-col pt-20 items-center">
            <div class="w-fit">
                <img src="{{asset('/assets/ctulogo.png')}}" alt="" class="w-24">
            </div>
            <p class="pb-2 font-bold text-xl">E-Portfolio System</p>
            <!-- Modal -->
            <main class="w-96 h-fit p-4 rounded-lg shadow-md shadow-gray-400 bg-white font-medium border">
                <!-- Body -->
                <p class="text-lg font-semibold pb-4">Login</p>
                <div class="space-y-2 mb-2">
                    <p for="" class="">Username</p>
                    <input x-model="username" type="text" class="rounded-md border border-gray-400 bg-gray-50 font-semibold px-2.5 p-1 w-full" placeholder="Input Username">
                    <template x-for="error in errors.username" class="w-fit">
                        <span x-text="error" class="text-xs text-rose-600 w-fit"></span></br>
                    </template>
                </div>
                <div class="space-y-2 mb-4">
                    <p for="" class="">Password</p>
                    <div class="flex">
                        <input x-on:keydown.enter.stop="handleSubmit" x-model="password" x-bind:type="canSee ? 'text' : 'password'" class="rounded-md border border-gray-400 bg-gray-50 font-semibold px-2.5 p-1 w-full" placeholder="Input Password">
                        <button x-on:click="handleCanSee" class="pl-1">
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
                    <button id="loginSubmitButton"></button>
                </div>
            </main>
        </div>
        @include('/pages/login/modals/greetingsModal')
    </main>

    <script>
         
        loadingButton({
            id:'loginSubmitButton',
            label: 'Login',
            onClick:'handleSubmit',
            param:'isLoading',
            width:'full',
            color:'red'
        })

        document.addEventListener('alpine:init',()=>{
            Alpine.data('data',()=>({
                modalType:'',
                isLoading:false,
                canSee:false,
                username:'',
                password:'',
                errors:{
                    username:[],
                    password:[]
                },

                init(){
                    setTimeout(() => {
                        this.modalType = 'greetingsModal'
                    }, 250);
                },

                handleCanSee(){
                    this.canSee = !this.canSee
                },

                handleSubmit(){
                    this.isLoading = true
                    axios.post('/loginSubmit',
                    {
                        username:this.username,
                        password:this.password
                    }
                    )
                    .then((res)=>{

                       window.location.pathname = '/dashboard'
                       this.isLoading = false
                    })
                    .catch((error)=>{
                        this.isLoading = false
                        if(error.request.status === 422)
                            this.errors = error.response.data.errors
                        else if(error.request.status === 401)
                        {
                            useToast({
                                message:'No Account Found',
                                type:'error'
                            })
                        }
                            
                    })
                },

                handleCloseModal(){
                    this.modalType=''
                }
            }))
        })
    </script>
</body>
</html>