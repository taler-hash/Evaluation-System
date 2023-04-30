<nav x-data="navBar"class="w-24  bg-red-800">
    <div class="w-full flex justify-center p-2 pb-6">
        <button 
            x-on:click="redirect('dashboard')"
            x-bind:disabled="activeLink == 'dashboard'"
            class="bg-white p-2 rounded-lg">
            <img src="{{ asset('/assets/ctulogo.png')}}" alt="" class="w-14">
        </button>
    </div>
    <ul class="w-full">
        @if(session('role') === 2)
        <li class="w-full p-2">
            <button 
                x-on:click="redirect('portfolios')"
                x-bind:disabled="activeLink == 'portfolios'"
                x-bind:class="activeLink === 'portfolios' ? 'bg-white shadow-md shadow-black font-bold text-black ' : 'cursor-pointer font-medium'" 
                class="flex justify-center items-center flex-col w-full transition hover:text-black hover:bg-white p-2  hover:shadow-md hover:shadow-black rouded-lg rounded hover:font-bold  text-white ">
                <div class="pb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                    </svg>
                </div>
                <p class=" text-xs">Portfolios</p>
            </button>
        </li>

        <li class="w-full p-2">
            <button 
                x-on:click="redirect('evaluation')"
                x-bind:disabled="activeLink == 'evaluation'"
                x-bind:class="activeLink === 'evaluation' ? 'bg-white shadow-md shadow-black font-bold text-black ' : 'cursor-pointer font-medium'" 
                class="flex justify-center items-center flex-col w-full transition hover:text-black hover:bg-white p-2  hover:shadow-md hover:shadow-black rouded-lg rounded hover:font-bold  text-white ">
                <div class="pb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25M9 16.5v.75m3-3v3M15 12v5.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                                     
                </div>
                <p class=" text-xs">Evaluation</p>
            </button>
        </li>
            
        <li class="w-full p-2">
            <button 
                x-on:click="redirect('supervisors')"
                x-bind:disabled="activeLink == 'supervisors'"
                x-bind:class="activeLink === 'supervisors' ? 'bg-white shadow-md shadow-black font-bold text-black ' : 'cursor-pointer font-medium'" 
                class="flex justify-center items-center flex-col w-full transition hover:text-black hover:bg-white p-2  hover:shadow-md hover:shadow-black rouded-lg rounded hover:font-bold  text-white ">
                <div class="pb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                    </svg>                      
                </div>
                <p class=" text-xs">Supervisors</p>
            </button>
        </li>

        <li class="w-full p-2">
            <button 
                x-on:click="redirect('students')"
                x-bind:disabled="activeLink == 'students'"
                x-bind:class="activeLink === 'students' ? 'bg-white shadow-md shadow-black font-bold text-black ' : 'cursor-pointer font-medium'" 
                class="flex justify-center items-center flex-col w-full transition hover:text-black hover:bg-white p-2  hover:shadow-md hover:shadow-black rouded-lg rounded hover:font-bold  text-white ">
                <div class="pb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                    </svg>
                                            
                </div>
                <p class=" text-xs">Students</p>
            </button>
        </li>
        @endif

        @if(session('role') === 3)
            <li class="w-full p-2">
                <button 
                    x-on:click="redirect('evaluateStudents')"
                    x-bind:disabled="activeLink == 'evaluateStudents'"
                    x-bind:class="activeLink === 'evaluateStudents' ? 'bg-white shadow-md shadow-black font-bold text-black ' : 'cursor-pointer font-medium'" 
                    class="flex justify-center items-center flex-col w-full transition hover:text-black hover:bg-white p-2  hover:shadow-md hover:shadow-black rouded-lg rounded hover:font-bold  text-white ">
                    <div class="pb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25M9 16.5v.75m3-3v3M15 12v5.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                                        
                    </div>
                    <p class=" text-xs">Evaluate Students</p>
                </button>
            </li>
        @endif
    </ul>
</nav>

@push('scripts')
<script>
    document.addEventListener('alpine:init',()=>{
        Alpine.data('navBar',()=>({
            activeLink:'',

            init(){
                const currentPath = window.location.pathname;
                    const segments = currentPath.split('/');
                    const page = segments[segments.length - 1];
                    console.log(page)
                    this.activeLink = page
            },

            redirect(location){
                window.location.pathname = `${location}`
            }
        }))
    })
</script>
@endpush