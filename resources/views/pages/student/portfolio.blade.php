@extends('layout.master')

@section('navContent')


@section('header', 'Portfolio')


@section('content')
<main x-data="studentPortfolio" class="relative px-8 flex w-full h-[calc(100%-7rem)] items-center justify-center overflow-y-auto">
    <section  class="overflow-y-auto w-fit bg-white rounded-lg border shadow-md shadow-gray-400 flex p-4 h-full">
        <div class="w-full">
            <div class="flex justify-between items-endw-full pb-2 space-x-2">
                <div class="font-medium text-lg ">Portfolio</div>
                <div  class=" flex items-center space-x-1"><p x-cloak x-show="deadline" class="">Deadline </p> <span x-text="stringDateConversion()" class="font-bold"></span> </div> 
            </div>
            
            <div class="pb-2">
                <p class=" font-medium my-1">Status:
                    <span x-text="portfolio === null ? 'None' : portfolio.status"
                        class="text-xs text-white font-bold px-1.5 py-0.5 rounded-full"
                        x-bind:class="
                        portfolio.status === 'submitted' ? 'bg-blue-500':
                        portfolio.status === 'correction' ? 'bg-yellow-500':
                        portfolio.status === 'updated' ? 'bg-sky-500':
                        portfolio.status === 'approved' ? 'bg-green-500':
                            'bg-red-500'
                    "></span>
                    <span x-show="portfolio.status === 'approved' &&portfolioDate !== 'no value'" x-bind:class="portfolioDate ? 'bg-green-500' : 'bg-amber-500'"  x-text="portfolioDate ? 'on-time' : 'late'"class=" text-xs text-white font-bold px-1.5 py-0.5 rounded-full">late</span>
                </p>
                <div x-cloak x-show="Object.keys(portfolio).length !== 0 && portfolio.status === 'correction'">
                    <object  type="application/pdf" x-bind:data="`/student/viewPdf/{{session('batchYear')}}/${portfolio.portfolio_name}`" width="600" height="400">
                        <p>Sorry, your browser doesn't support embedded PDFs.</p>
                    </object>
                    <p class="pt-4">Comments</p>
                    <div x-text="portfolio.comment" class="text-xs px-2 pb-4"></div>
                </div>
                
                <p x-cloak x-show="Object.keys(portfolio).length === 0" class="font-medium text-sm"></p>
                <div x-cloak x-show="Object.keys(portfolio).length === 0">
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="file_input">Upload pdf</label>
                    <input x-on:change="pdf = $event.target.files[0]" accept="application/pdf" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 " aria-describedby="file_input_help" id="file_input" type="file">
                    <template x-for="error in errors.pdf" class="w-fit">
                        <span x-text="error" class="text-xs text-rose-600 w-fit"></span><br>
                    </template>
                    <p class="mt-1 text-sm text-gray-500">PDF File</p>
                    <div class="mt-2 flex justify-center" >
                        <button id="SubmitAddPortfolio"></button>
                    </div>
                    
                </div>
                <div  x-cloak x-show="Object.keys(portfolio).length !== 0" >
                    <div x-cloak x-show="portfolio.status === 'correction'" class="">
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="file_input">Update pdf</label>
                        <input x-on:change="pdf = $event.target.files[0]" accept="application/pdf" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 " aria-describedby="file_input_help" id="file_input" type="file">
                        <template x-for="error in errors.pdf" class="w-fit">
                            <span x-text="error" class="text-xs text-rose-600 w-fit"></span><br>
                        </template>
                        <p class="mt-1 text-sm text-gray-500">PDF File</p>
                        <div class="mt-2 flex justify-center" >
                            <button id="SubmitUpdatePortfolio"></button>
                        </div>
                    </div>
                    <div x-show="portfolio.status !== 'correction'" class="flex space-x-1 items-center">
                        
                        <object  type="application/pdf" x-bind:data="`/student/viewPdf/{{session('batchYear')}}/${portfolio.portfolio_name}`" width="600" height="400">
                            <p>Sorry, your browser doesn't support embedded PDFs.</p>
                        </object>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </section>

</main>

@push('scripts')
<script>

        loadingButton({
                id:'SubmitAddPortfolio',
                label: 'Submit',
                onClick:'handleSubmitPortfolio("submitted")',
                param:'isLoading',
                width:'fit',
                color:'red'
        })

        loadingButton({
                id:'SubmitUpdatePortfolio',
                label: 'Submit',
                onClick:'handleSubmitPortfolio("updated")',
                param:'isLoading',
                width:'fit',
                color:'red'
        })

    document.addEventListener('alpine:init',()=>{
        Alpine.data('studentPortfolio',()=>({
            isLoading:false,
            portfolio:{},
            deadline:'',
            portfolioDate:true,
            pdf:'',
            errors:{
                pdf:[]
            },

            init(){
                this.fetchPortfolio()
                this.fetchDeadline().then((res)=>{
                    this.stringDateConversion()
                    this.dateCompare()
                })
                
            },

            fetchPortfolio(){
                axios.get('/student/fetchPortfolio')
                .then((res)=>{
                    this.portfolio = res.data
                    console.log(res.data)
                })
                .catch((err)=>{
                    
                })
            },

            async fetchDeadline(){
                await axios.get('/student/fetchDeadline')
                .then((res)=>{ this.deadline = res.data[0]
                })
            },

            dateCompare() {
                if(this.deadline)
                {
                    // Convert the input date string to a Date object
                    const date = new Date(this.portfolio.approved_at);

                    // Create a Date object for May 8th, 2023
                    const dateArray = this.deadline.date.split("/").map(Number);
                    const dateToCompare = new Date(dateArray[2], dateArray[0] - 1, dateArray[1]); // Note: month is zero-indexed
                    console.log(date)
                    // Compare the two dates
                    this.portfolioDate =  date <= dateToCompare;
                }
                else
                {
                    this.portfolioDate = 'no value'
                }
            },

            stringDateConversion(){
                if(this.deadline)
                {
                    const inputDate = this.deadline.date;
                    const date = new Date(inputDate);
                    const options = { month: 'long', day: 'numeric', year: 'numeric' };
                    const outputDate = date.toLocaleDateString('en-US', options);
                    return outputDate;
                }
                return "No deadline is set"
            },

            handleSubmitPortfolio(status){
                console.log(status)
                let formData = new FormData()
                formData.append('pdf',this.pdf)
                formData.append('status',status)
                axios.post('/student/uploadDocument', formData)
                .then((res)=>{
                    if(res.data === 'success')
                    {
                        for(let prop in this.errors){
                        this.errors[prop] = [];
                        }

                        this.fetchPortfolio()
                        
                        useToast({
                            message:'Portfolio Submitted',
                            type:'success'
                        })
                    }
                    
                })
                .catch((error)=>{
                    this.errors = error.response.data.errors
                })
            }
        }))
    })
</script>
@endpush
@endsection

@push('scripts')

@endpush