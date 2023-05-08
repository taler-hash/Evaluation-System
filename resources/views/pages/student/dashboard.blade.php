<main x-data="studentPortfolio" class="relative px-8 flex w-full h-[calc(100%-7rem)] items-center justify-center">
    <section  class=" w-fit bg-white rounded-lg border shadow-md shadow-gray-400 flex p-4">
        <div class="w-full">
            <div class="flex justify-between w-full">
                <p class="font-medium text-lg pb-4">Portfolio</p>
            </div>
            
            <div class="pb-2">
                <p x-cloak x-show="Object.keys(portfolio).length === 0" class="font-medium text-sm">Document Name</p>
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
                        <p class="font-medium">PDF:</p>
                        <a  x-bind:href="`/student/viewPdf/{{session('batchYear')}}/${portfolio.portfolio_name}`" target="_blank" class="text-lg font-medium rounded-lg py-0.5 px-1 bg-green-500 hover:bg-green-600 transition text-white">View</a>
                    </div>
                    <p class=" font-medium mt-2">Status:
                        <span x-text="portfolio === null ? 'None' : portfolio.status"
                            class="text-xs text-white font-bold px-1.5 py-0.5 rounded-full"
                            x-bind:class="
                            portfolio.status === 'submitted' ? 'bg-blue-500':
                            portfolio.status === 'correction' ? 'bg-yellow-500':
                            portfolio.status === 'updated' ? 'bg-sky-500':
                            portfolio.status === 'approved' ? 'bg-green-500':
                                'bg-red-500'
                            "></span>
                
                    </p>
                </div>
                
            </div>
            <div x-cloak x-show="Object.keys(portfolio).length !== 0 && portfolio.status === 'correction'" class="font-medium">
                <div class="flex items-center space-x-1">
                    <p class="font-medium">PDF:</p>
                    <a  x-bind:href="`/student/viewPdf/{{session('batchYear')}}/${portfolio.portfolio_name}`" target="_blank" class="text-sm font-medium rounded-lg py-0.5 px-1 bg-green-500 hover:bg-green-600 transition text-white">View last uploaded</a>
                </div>
                <p class="">Comments</p>
                <div x-text="portfolio.comment" class="text-xs px-2"></div>
            </div>
        </div>
    </section>
    <aside x-cloak x-show="deadline" class="absolute top-0 overflow-hidden left-8 font-medium border w-fit rounded-lg bg-white shadow-shadow-lg shadow-md shadow-gray-400">
        <div class="relative">
            <div class="absolute top-0 left-0 h-24 w-1 bg-blue-500"></div>
            <div class="p-4">Deadline of Portfolio will be on <span x-text="stringDateConversion()" class="font-bold">June 28,2023</span> </div> 
        </div>
    </aside>
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
            pdf:'',
            errors:{
                pdf:[]
            },

            init(){
                this.fetchPortfolio()
                this.fetchDeadline()
                this.stringDateConversion()
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

            fetchDeadline(){
                axios.get('/student/fetchDeadline')
                .then((res)=>{ this.deadline = res.data[0]
                console.log(res.data)})
            },

            stringDateConversion(){
                const inputDate = this.deadline.date;
                const date = new Date(inputDate);
                const options = { month: 'long', day: 'numeric', year: 'numeric' };
                const outputDate = date.toLocaleDateString('en-US', options);
                return outputDate;
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