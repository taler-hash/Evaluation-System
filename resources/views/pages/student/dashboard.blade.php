<main class="px-8 flex w-full h-[calc(100%-7rem)] items-center justify-center">
    <section x-data="studentPortfolio" class=" w-fit bg-white rounded-lg border shadow-md shadow-gray-400 flex p-4">
        <div class="w-full">
            <div class="flex justify-between w-full">
                <p class="font-medium text-lg pb-4">Portfolio</p>
                <p x-text="portfolio.status" class="text-xs font-medium text-white p-2 rounded-full bg-green-500 h-fit w-fit"></p>
            </div>
            
            <div class="pb-2">
                <p x-cloak x-show="portfolio" class="font-medium text-sm">Document Name</p>
                <template x-if="!portfolio">
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="file_input">Upload file</label>
                    <input accept="application/pdf" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 " aria-describedby="file_input_help" id="file_input" type="file">
                    <p class="mt-1 text-sm text-gray-500">PDF File</p>
                </template>
                <template x-if="portfolio">
                    <a x-bind:href="`/student/viewPdf/{{session('batchYear')}}/${portfolio.portfolio_name}`" target="_blank" x-text="portfolio.portfolio_name" class="font-bold text-2xl"></a>
                </template>
                
            </div>
            <div class="font-medium">
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
    document.addEventListener('alpine:init',()=>{
        Alpine.data('studentPortfolio',()=>({
            portfolio:[],
            
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
                    console.log(err)
                })
            }
        }))
    })
</script>
@endpush