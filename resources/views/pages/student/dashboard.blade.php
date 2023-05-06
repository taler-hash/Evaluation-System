<main class="px-8 flex w-full h-[calc(100%-7rem)] items-center justify-center">
    <section x-data="studentPortfolio" class=" w-fit bg-white rounded-lg border shadow-md shadow-gray-400 flex p-4">
        <div class="w-full">
            <div class="flex justify-between w-full">
                <p class="font-medium text-lg pb-4">Portfolio</p>
                    <p x-cloak x-show="Object.keys(portfolio).length === 0" x-text="portfolio.status" class="text-xs font-medium text-white p-2 rounded-full bg-green-500 h-fit w-fit"></p>
            </div>
            
            <div class="pb-2">
                <p x-cloak x-show="Object.keys(portfolio).length === 0" class="font-medium text-sm">Document Name</p>
                <div x-cloak x-show="Object.keys(portfolio).length === 0">
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="file_input">Upload file</label>
                    <input x-on:change="pdf = $event.target.files[0]" accept="application/pdf" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 " aria-describedby="file_input_help" id="file_input" type="file">
                    <template x-for="error in errors.pdf" class="w-fit">
                        <span x-text="error" class="text-xs text-rose-600 w-fit"></span><br>
                    </template>
                    <p class="mt-1 text-sm text-gray-500">PDF File</p>
                    <div class="mt-2 flex justify-center" >
                        <button id="SubmitAddPortfolio"></button>
                    </div>
                </div>
                <div  x-cloak x-show="Object.keys(portfolio).length !== 0">
                    <a x-bind:href="`/student/viewPdf?batchYear={{session('batchYear')}}&portfolioName=${portfolio.portfolio_name}`" target="_blank" x-text="portfolio.portfolio_name" class="font-bold text-2xl"></a>
                </div>
                
            </div>
            <div x-cloak x-show="portfolio.length !== undefined" class="font-medium">
                <p class="">Comment</p>
                <div x-text="portfolio.comment" class="text-xs px-2">
                    asdjlyasufhasfaskl  
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
                onClick:'handleSubmitPortfolio',
                param:'isLoading',
                width:'fit',
                color:'red'
        })

    document.addEventListener('alpine:init',()=>{
        Alpine.data('studentPortfolio',()=>({
            isLoading:false,
            portfolio:{},
            pdf:'',
            errors:{
                pdf:[]
            },

            init(){
                this.fetchPortfolio()
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

            handleSubmitPortfolio(docs){
                console.log(this.portfolio.length)
                let formData = new FormData()
                formData.append('pdf',this.pdf)

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