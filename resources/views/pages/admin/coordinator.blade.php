@extends('layout.master')

@section('navContent')


@section('header', 'Coordinator')


@section('content')
    <div class="px-8 w-full h-[calc(100%-4.78rem)] overflow-hidden">
        <div x-data="adminData"  class="w-full h-full">
            <div class="flex items-center justify-between pb-2 ">
                <div>
                    <button x-on:click="handleOpenAddCoordinatorModal('addCoordinatorModal')" type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 transition">
                        Add
                    </button>
                </div>
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 " aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                    </div>
                    <input x-model="searchString" x-on:input.debounce.500ms="handleSearch" type="text" id="table-search-users" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search for Coordinator">
                </div>
            </div>
            <div class="w-full max-h-[calc(100%-7rem)] overflow-auto">
                <table class="w-full text-sm text-left text-gray-500 shadow-md shadow-gray-400 border">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 sticky top-0">
                        <tr>
                            <th scope="col" class="p-4">
                                #
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Username
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Contact
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr x-cloak x-show="isLoading" class="p-4">
                            <td colspan="9" class="w-full text-center bg-white p-4 m-4">
                                <span class="p-4 bg-red-500 font-bold text-white rounded-lg">Loading</span>
                            </td>
                        </tr>
                        <template x-for="(data, index) in datas">
                            <tr x-cloak x-show="!isLoading" class="bg-white border-b hover:bg-gray-50">
                                <td x-text="index + 1" class="w-4 p-4"></td>
                                <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap">
                                    <div x-text="data.full_name.charAt(0)" class="p-3 h-fit rounded-lg bg-red-500 text-lg font-bold text-white capitalize"></div>
                                    <div class="pl-3">
                                        <div x-text="data.full_name" class="text-base font-semibold capitalize"></div>
                                        <div x-text="data.course_handled" class="text-sm font-medium capitalize text-gray-600"></div>
                                    </div>  
                                </th>
                                <td x-text="data.user_name" class="px-6 py-4"></td>
                                <td  x-text="data.email" class="px-6 py-4"></td>
                                <td  x-text="data.contact_number" class="px-6 py-4"></td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div 
                                            x-bind:class="data.status === 'active' ? 'bg-green-500' : 'bg-red-500' "
                                            class="h-2.5 w-2.5 rounded-full mr-2"></div> <p class="capitalize" x-text="data.status"></p>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <button x-on:click="handleOpenEditModal(data.id)" href="#" class="font-medium text-blue-600  hover:underline">Edit</button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
            <div id="coordinatorPagination" class="pt-2">
            </div>
            @include('/pages/admin/modals/addCoordinatorModal')
            @include('/pages/admin/modals/editCoordinatorModal')
        </div>
    </div>
@endsection

@push('scripts')

<script>



    usePagination({id:'coordinatorPagination'})

    loadingButton({
            id:'SubmitAddCoordinator',
            label: 'Submit',
            onClick:'handleSubmitAddCoordinator',
            param:'isLoading',
            width:'fit',
            color:'red'
    })

    loadingButton({
            id:'SubmitUpdateCoordinator',
            label: 'Update',
            onClick:'handleUpdateSubmit',
            param:'isLoading',
            width:'fit',
            color:'red'
    })

    document.addEventListener('alpine:init',()=>{
        Alpine.data('adminData',()=>({
            page: 1,
            searchString:'',
            datas:[],
            links:[],
            modalType:'',
            canSee:false,
            isLoading:false,
            course:[],

            input:{
                id:'',
                full_name:'',
                user_name:'',
                password:'',
                email:'',
                contact_number:'',
                course_handled:"",
                status:'',
            },
            errors:{
                full_name:[],
                user_name:[],
                password:[],
                email:[],
                contact_number:[],
                course_handled:[],
                status:[],
            },

            init(){
                this.fetchCoordinator()
            },


            fetchCoordinator(){
                axios.get(`/admin/fetchCoordinator?page=${this.page}`,
                {
                    params:
                    {
                        searchString:this.searchString
                    }
                })
                .then((res)=>{
                    this.course = res.data.course
                    this.links = res.data.coordinator.links
                    this.datas = res.data.coordinator.data
                    this.links =this.links.map((v,i)=>{
                        if(i === 0)
                            return {...v, label:'Prev'}
                        if(i === this.links.length - 1)
                            return {...v, label:'Next'}
                        return v
                    })
                    this.isLoading = false
                    console.log(this.datas)
                })
                .catch((err)=>{
                    console.log(err)
                })
            },

            handleSearch(){
                this.fetchCoordinator()
            },

            clearInputs()
            {
                for(let prop in this.input){
                        this.input[prop] = ''
                    }
                for(let prop in this.errors){
                    this.errors[prop] = [];
                }
            },

            handleCanSee(){
                this.canSee = !this.canSee
            },

            handleOpenAddCoordinatorModal(modalType){
                
                this.modalType = modalType
            },

            handleCloseModal(modalType){
                if(!modalType)
                {
                    this.clearInputs()
                }

                this.modalType = ''
            },

            handleSubmitAddCoordinator(){
                this.isLoading = true
                this.input.full_name = this.input.full_name.toLowerCase();
                axios.post('/admin/addCoordinator', this.input)
                .then((res)=>{
                    if(res.data === 'success')
                    {
                        useToast({
                            message:'Coordinator Added Successfully',
                            type:'success'
                        })
                        this.fetchCoordinator()
                        this.clearInputs()
                        
                    }
                    console.log(res)
                    this.modalType =''
                    this.isLoading = false
                })
                .catch((err)=>{
                    this.isLoading = false
                    this.errors = err.response.data.errors
                })
            },

            handleOpenEditModal(id){
                console.log(id)
                this.modalType = 'editCoordinatorModal'
                let filteredData = this.datas.filter((v)=>{
                    return v.id === id
                })[0]
                for (let i in this.input) {
                    for (let f in filteredData) {
                        if(i === f && i !== 'password' ){
                            this.input[f] = filteredData[f]
                        }
                    }
                }
                
                this.defaultInput = JSON.stringify(this.input)            
            },

            handleUpdateSubmit(){
                if(this.defaultInput === JSON.stringify(this.input))
                {
                    useToast({
                        message:'No Changes were Made',
                        type:'info'
                    })
                }
                else
                {
                    console.log(this.input)
                    this.isLoading = true
                    axios.post('/admin/updateCoordinator', this.input)
                    .then((res)=>{
                        
                        if(res.data === 'success')
                        {
                            useToast({
                                message:'Coordinator Updated Successfully',
                                type:'success'
                            })
                            this.isLoading = false
                            this.modalType = ''
                            this.fetchCoordinator()
                            this.clearInputs()
                            
                        }
                    })
                    .catch((err)=>{
                        this.errors = err.response.data.errors
                        this.isLoading = false
                    })
                }
                
            },


        }))
    })
</script>
@endpush