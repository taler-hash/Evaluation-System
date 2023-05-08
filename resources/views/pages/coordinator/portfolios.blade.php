@extends('layout.master')

@section('navContent')

@endsection

@section('header', 'Portfolios')


@section('content')
<div x-data="portfolio" class="px-8 overflow-hidden h-[calc(100%-5rem)]">
    <div class="flex items-center space-x-1">
        <div class="flex space-x-2 items-center">
            <div class="shrink">
                <p class="font-medium">Batch Year</p>
            </div>
            <select x-model="selectedYear" class="bg-gray-50 border border-gray-300 rounded-lg font-semibold focus:ring-blue-500 focus:border-blue-500 block w-fit p-2.5">
                <template x-for="data in batchYears">
                    <option x-text="data.batch_year" x-bind:value="data.batch_year"></option>
                </template>
            </select>
        </div>
        <button x-on:click="selected = ''; comment = ''" class="px-2 py-1 bg-red-500 transition hover:bg-red-600 text-sm font-bold text-white rounded-lg">Hide</button>
    </div>
    
    <div  class=" w-full max-h-[calc(100%-4.78rem)] overflow-y-auto flex justify-center flex-wrap">
        <template x-for="(data, index) in students">
            <div class="p-2 ">
                <div  class=" w-fit h-fit bg-white p-4 shadow-md shadow-gray-400 border  rounded-lg">
                    <div class="flex items-center justify-center">
                        <div class="">
                            <p x-text="data.full_name" class="font-bold text-lg capitalize"></p>
                                <a
                                    class="text-sm font-medium rounded-lg py-0.5 px-1 bg-green-500 hover:bg-green-600 transition text-white"
                                    x-show ="data.portfolio !== null " 
                                    x-bind:href="data.portfolio !== null && `/student/viewPdf/${batchYears[0].batch_year}/${data.portfolio.portfolio_name}`" target="_blank" 
                                >
                                View
                                </a>
                                <p x-show="data.portfolio === null" class="font-medium text-sm ">No Document yet</p>
                            <div x-show="data.portfolio !== null" class="">
                                <p class="text-xs font-medium mt-2">Status:
                                    <span x-text="data.portfolio === null ? 'None' : data.portfolio.status"
                                        class="text-xs text-white font-bold px-1.5 py-0.5 rounded-full"
                                        x-bind:class="
                                        data.portfolio !== null && data.portfolio.status === 'submitted' ? 'bg-blue-500':
                                        data.portfolio !== null && data.portfolio.status === 'correction' ? 'bg-yellow-500':
                                        data.portfolio !== null && data.portfolio.status === 'updated' ? 'bg-sky-500':
                                        data.portfolio !== null && data.portfolio.status === 'approved' ? 'bg-green-500':
                                            'bg-red-500'
                                        "></span>
                            
                                </p>
                                <div class="mt-4" x-show="data.portfolio !== null && data.portfolio.status !== 'correction' && data.portfolio.status !== 'approved'">
                                    <button x-on:click="handleApprovePortfolio(data.student_number)" class="text-sm font-medium text-white px-2 py-1 rounded-lg transition bg-green-600 hover:bg-green-700">Approve</button>
                                </div>
                                <div x-show="data.portfolio !== null && data.portfolio.status !== 'correction' && data.portfolio.status !== 'approved'" class="mt-2">
                                    <button x-on:click.stop="selected = index" class="text-sm font-medium text-white px-2 py-1 rounded-lg transition bg-blue-600 hover:bg-blue-700">Comment</button>
                                    <button 
                                        x-bind:disabled="comment.length === 0" 
                                        x-on:click="handleSubmitComment(data.student_number)" 
                                        x-show="index === selected" 
                                        class="text-sm font-medium text-white px-2 py-1 rounded-lg transition bg-red-600 hover:bg-red-700">
                                        Submit
                                    </button>
                                </div>
                                <div x-show="data.portfolio !== null && data.portfolio.status === 'correction'" class="mt-2">
                                    <button 
                                        x-on:click.stop="selected = index" 
                                        class="text-sm font-medium text-white px-2 py-1 rounded-lg transition bg-yellow-500 hover:bg-yellow-600">
                                        Show Comment
                                    </button>
                                    <div x-show="data.portfolio !== null && index === selected " class="pt-2 font-medium">
                                        <p class="mb-2 text-sm">Comments</p>
                                        <p class="text-xs" x-text="data.portfolio !== null ? data.portfolio.comment : ''"></p>
                                    </div>
                                </div>
                                <div 
                                    x-cloak
                                    x-show="data.portfolio !== null && index === selected &&  data.portfolio.status !== 'correction'"
                                    class=" mt-4"
                                    >
                                    <textarea x-model="comment" name="" class="border border-gray-300 p-1" id="" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                            
                        </div>
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-gray-700">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        
        
    </div>
</div>

@endsection

@push('scripts')

<script>
    document.addEventListener('alpine:init',()=>{
        Alpine.data('portfolio',()=>({
            selected:'',
            comment:'',
            batchYears:[],
            selectedYear:'',
            students:[],

            init(){
                this.fetchAllBatchYears()

                this.$watch('selectedYear', ()=>{ 
                    this.fetchStudentsPortfolio()})
            },

            fetchAllBatchYears(){
                axios.get('/coordinator/getAllBatchYears')
                .then((res)=>{

                    this.batchYears = res.data
                    this.selectedYear = res.data[0]
                    this.fetchStudentsPortfolio()
                })
                .catch((err)=>{
                    console.log(err)
                })
            },

            fetchStudentsPortfolio(){
                axios.get('/coordinator/fetchStudentsPortfolio',
                {
                    params : 
                    {
                        selectedYear:this.selectedYear
                    }
                }
                )
                .then((res)=>{
                    this.students = res.data
                })
                .catch((err)=>{
                    console.log(err)
                })
            },

            handleSubmitComment(studentNumber){
                console.log(studentNumber)
                axios.post('/coordinator/addComment',
                {
                    student_number:studentNumber,
                    comment:this.comment
                })
                .then((res)=>{
                    if(res.data === 'success')
                    {
                        useToast({
                            message:"Comment Added",
                            type:'success'
                        })
                        this.fetchAllBatchYears()
                        this.fetchStudentsPortfolio()
                        this.comment = ''
                        this.selected = ''
                    }
                })
            },

            handleApprovePortfolio(studentNumber){
                axios.post('/coordinator/approvePortfolio',
                {
                    student_number:studentNumber
                })
                .then((res)=>{
                    if(res.data === 'success')
                    {
                        useToast({
                            message:"Approved Successfully",
                            type:'success'
                        })
                        this.fetchAllBatchYears()
                        this.fetchStudentsPortfolio()
                    }
                })
            }
        }))
    })
</script>
@endpush