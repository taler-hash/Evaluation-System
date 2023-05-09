<!DOCTYPE html>
<html lang="en">
    @include('/components/head')
    <title>@yield('header')</title>
<body>
    <main class="w-full min-h-screen h-screen bg-white">
        <div x-data class="flex w-full h-full">
            <!-- Content -->
            <section  class="w-screen h-full bg-[url('{{asset('/assets/dashboard-bg.jpg')}}')] bg-cover">
                <div class="w-full h-fit p-4 px-8">
                    <div class="w-full flex justify-between items-center">
                        <div class="font-bold text-2xl flex items-center space-x-1">
                            <a href="/dashboard" class="transition hover:scale-105">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                                  </svg>                                  
                            </a>
                            <p class="">Information</p>
                        </div>
                        <div x-data="data" class="relative">
                            <button x-on:click.stop="handleCanSeeSettings" x-text="firstLetter" class="font-bold capitalize text-white rounded-lg p-2 px-4 border-amber-600 border-2 bg-amber-400"></button>
                            <div x-cloak x-show="canSeeSettings" x-on:click.away="handleCanSeeSettings" class="absolute z-50 top-12 right-0 w-56 pb-4 bg-white shadow-md shadow-gray-400  rounded-lg border border-gray-400 overflow-hidden">
                                <div class="flex items-center pb-2 p-4">
                                    <p x-text="firstLetter" class="font-bold capitalize text-white rounded-lg p-2 px-4 border-amber-600 border-2 bg-amber-400"></p>
                                    <div class="pl-2">
                                        <p class="font-medium text-sm capitalize">{{session('fullName')}}</p>
                                        <p class="font.medium text-xs">{{ session('roleName')}}</p>
                                    </div>
                                </div>
                                <ul class="w-full cursor-pointer">
                                    <li x-on:click="handleLogOut" class="transition hover:bg-red-200 py-2 px-4 flex items-center w-full border-y">
                                        <div class="w-[3.2rem] flex justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                            </svg>  
                                        </div>
                                        <p class=" font-medium text-sm">Log Out</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div x-data="changeInfo" class="w-full h-[calc(100%-4.8rem)] flex justify-center px-8 overflow-hidden">
                    @include('/pages/changeInfo/card')
                </div>
            </section>
        </div>
    </main>  
</body>
    <!-- Scripts -->
    @stack('scripts')
    <script>
        document.addEventListener('alpine:init',()=>{
            Alpine.data('data',()=>({
                firstLetter: '',
                canSeeSettings:false,
                init()
                { 
                    var string = '{{session('fullName')}}'
                    this.firstLetter = string.charAt(0)
                },

                handleLogOut(){
                    axios.post('/logOut')
                    .then(()=>{
                        location.reload()
                    })
                },

                handleCanSeeSettings(){
                    this.canSeeSettings = !this.canSeeSettings
                }
            }))
        })
    </script>
</html>