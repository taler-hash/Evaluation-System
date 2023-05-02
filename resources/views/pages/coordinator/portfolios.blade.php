@extends('layout.master')

@section('navContent')
<a href="/coordinator/portfolio" class="">asss</a>
@endsection

@section('header', 'Portfolios')


@section('content')
<div x-data="portfolio" class="px-8">
    <div   class="flex space-x-2 items-center">
        <div class="shrink">
            <p class="font-medium">Choose Batch Year</p>
        </div>
        
        <select class="bg-gray-50 border border-gray-300 rounded-lg font-semibold focus:ring-blue-500 focus:border-blue-500 block w-fit p-2.5">
            <template x-for="data in batchYears">
                <option x-text="data.batch_year" x-bind:value="data.batch_year"></option>
            </template>
            
        </select>
    </div>
    
    <div class=" w-full max-h-[calc(100%-4.78rem)] overflow-y-auto flex justify-center flex-wrap">
        <template x-for="data in students">
            <div class="p-2 ">
                <div class="cursor-pointer transition hover:scale-105 relative w-fit h-fit bg-white bg-contain bg-no-repeat p-4 shadow-md shadow-gray-400 border  rounded-lg">
                    <div class="absolute top-[-7px] right-[-5px] w-3 h-3 rounded-full bg-red-500"></div>
                    <div class="flex items-center justify-center">
                        <div class="pr-4">
                            <p x-text="data.full_name" class="font-bold text-lg">Jurie Tylier Pedrogas</p>
                            <p x-text="data.portfolio === null ? 'No Documents yet' : data.portfolio.portfolio_name" class="text-sm font-medium"></p>
                           <p class="text-xs font-medium">Status: <span x-text="data.portfolio === null ? 'None' : data.portfolio.status" class="text-sm font-medium uppercase"></span></p>
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
            batchYears:[],
            selectedYear:'',
            students:[],

            init(){
                this.fetchAllBatchYears()
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
                    console.log(res.data)
                })
                .catch((err)=>{
                    console.log(err)
                })
            }
        }))
    })
</script>
@endpush