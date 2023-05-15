@extends('layout.master')

@section('navContent')


@section('header', 'Courses')


@section('content')
    <div class="px-8 w-full h-[calc(100%-4.78rem)] overflow-hidden">
        <div x-data="coursesData"  class="w-full h-full flex justify-center">
            <div class="min-w-[30%] max-h-fit h-96 border border-gray-300 rounded-lg shadow-md shadow-gray-400 bg-white overflow-y-auto overflow-x-hidden">
                <div class="w-full bg-white sticky top-0 pt-4 px-4">
                    <button x-on:click="modalType = 'addCourseModal'" type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 ">Add</button>
                </div>
                <div class="p-4">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 sticky top-16">
                        <tr>
                            <th scope="col" class="px-6 py-3">#</th>
                            <th scope="col" class="px-6 py-3">Course</th>
                            <th scope="col" class="px-6 py-3">Actions</th>
                        </tr> 
                    </thead>
                    <tbody>
                        <template x-for="(course, index) in datas">
                            <tr class="bg-white border-b">
                                <th x-text="index" class="px-6 py-4"></th>
                                <th x-text="course.course" scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap uppercase"></th>
                                <th class="px-6 py-4">
                                    <button x-on:click="handleDeleteCourse(course.id)" class="text-red-500 w-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                          </svg>                                          
                                    </button>
                                </th>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
            @include('/pages/admin/modals/addCourseModal')
            </div>
        </div>
    </div>
@endsection

@push('scripts')

<script>

loadingButton({
            id:'SubmitAddCourse',
            label: 'Submit',
            onClick:'handleAddCourse',
            param:'isLoading',
            width:'fit',
            color:'red'
    })

    document.addEventListener('alpine:init',()=>{
        Alpine.data('coursesData',()=>({
            input:{
                course:''
            },
            errors:{
                course:[]
            },
            isLoading:false,
            datas:[],
            modalType:'',

            init(){
                this.fetchCourses()
            },

            fetchCourses(){
                axios.get('/admin/fetchCourses')
                .then((res)=>{
                    this.datas = res.data
                })
            },

            clearInputs()
            {
                for(let prop in this.input){
                        this.input[prop] = ''
                    }
                for(let prop in this.errors){
                    this.errors[prop] = [];
                }
                this.modalType = ''
            },

            handleAddCourse(){
                axios.post('/admin/addCourse',
                this.input)
                .then((res)=>{
                    
                    if(res.data = "success")
                    {
                        useToast({
                            message:'Course Added Successfully',
                            type:'success'
                        })
                        this.clearInputs()
                        this.fetchCourses()
                    }
                    
                })
                .catch((err)=>{
                    this.errors = err.response.data.errors
                })
            },

            handleCloseModal(){
                if(!this.modalType)
                {
                    this.clearInputs()
                }
                this.clearInputs()
                this.modalType = ''
            },

            handleDeleteCourse(id){
                axios.post('/admin/deleteCourse',{id:id})
                .then((res)=>{
                    if(res.data == 'success')
                    {
                        useToast({
                            message:'Course Deleted Successfully',
                            type:'success'
                        })
                        this.fetchCourses()
                    }
                })
            }
        }))
    })
</script>
@endpush