
  <!-- Main modal -->
  <div 
  x-cloak
  x-show="modalType === 'viewEvaluationModal'" x-transition:enter="transition duration-200 transform origin-center"
  x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
  x-transition:leave="transition duration-200"
  x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0 delay-100" tabindex="-1" aria-hidden="true" class=" bg-gray-400/50  flex justify-center fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-full max-h-full">
      <div class="relative w-[30rem] h-full">
          <!-- Modal content -->
          <div 
            x-show="modalType === 'viewEvaluationModal'" x-transition:enter="transition delay-100 duration-200 transform origin-center"
            x-transition:enter-start="scale-0" x-transition:enter-end="scale-100"
            x-transition:leave="transition duration-200 transform origin-center"
            x-transition:leave-start="scale-100" x-transition:leave-end="scale-0"
            class="relative bg-white rounded-lg shadow">
              <!-- Modal header -->
              <div class="flex items-start justify-between p-4 border-b rounded-t ">
                  <h3 class="text-xl font-semibold text-gray-900 ">
                      Evaluation Comment
                  </h3>
                  <button x-on:click="handleModal('')" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" input-modal-hide="defaultModal">
                      <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                      <span class="sr-only">Close modal</span>
                  </button>
              </div>
              <!-- Modal body -->
              <div class="class p-6 ">
                <div class="flex items-center pb-2">
                    <div x-text="defaultData.full_name.charAt(0)" class="p-3 h-fit rounded-lg bg-red-500 text-lg font-bold text-white capitalize"></div>
                    <div class="pl-3">
                        <div x-text="defaultData.full_name" class="text-base font-semibold capitalize"></div>
                        <div x-text="defaultData.student_number" class="font-normal text-sm text-gray-500 capitalize"></div>
                        <div x-text="defaultData.course" class="font-normal text-xs text-gray-500 capitalize"></div>
                    </div>  
                </div>
                <div class="w-full h-[calc(100vh-15rem)] space-y-3 overflow-y-auto">
                    <template x-for="(data, index) in defaultData.comments">
                        <div class="relative p-2 border shadow-md rounded-lg shadow-gray-400">
                            <div 
                                x-bind:class="
                                data.rating === 'excellent' ? 'bg-green-500' :
                                data.rating === 'very good' ? 'bg-lime-500' :
                                data.rating === 'good' ? 'bg-yellow-500' :
                                data.rating === 'fair' ? 'bg-orange-500' :
                                'bg-red-500'"
                                class="absolute top-[-7px] right-0 w-3 h-3 rounded-full"></div>
                            <div class="flex justify-between">
                                <p class="pb-2 font-semibold">Week <span x-text="defaultData.comments.length - index" class=""></span></p>
                                <p x-text="data.evaluated_at" class="text-xs font-medium"></p>
                            </div>
                            <p x-text="data.comment" class="text-sm font-medium"></p>
                        </div>
                    </template>
                </div>
              </div>
          </div>
      </div>
  </div>
  