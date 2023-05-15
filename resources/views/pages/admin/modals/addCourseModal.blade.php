
  <!-- Main modal -->
  <div 
  x-cloak
  x-show="modalType === 'addCourseModal'" x-transition:enter="transition duration-200 transform origin-center"
  x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
  x-transition:leave="transition duration-200"
  x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0 delay-100" tabindex="-1" aria-hidden="true" class=" bg-gray-400/50  flex justify-center fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-full max-h-full">
      <div class="relative w-[30rem] h-full">
          <!-- Modal content -->
          <div 
            x-show="modalType === 'addCourseModal'" x-transition:enter="transition delay-100 duration-200 transform origin-center"
            x-transition:enter-start="scale-0" x-transition:enter-end="scale-100"
            x-transition:leave="transition duration-200 transform origin-center"
            x-transition:leave-start="scale-100" x-transition:leave-end="scale-0"
            class="relative bg-white rounded-lg shadow">
              <!-- Modal header -->
              <div class="flex items-start justify-between p-4 border-b rounded-t ">
                  <h3 class="text-xl font-semibold text-gray-900 ">
                      Add Course
                  </h3>
                  <button x-on:click="handleCloseModal()" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="defaultModal">
                      <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                      <span class="sr-only">Close modal</span>
                  </button>
              </div>
              <!-- Modal body -->
              <div class="p-6">
                <div class="space-y-2 mb-2">
                    <p for="" class="">Course<span class="text-red-500">*</span></p>
                    <input x-model="input.course" type="text" class="rounded-md border border-gray-400 bg-gray-50 font-semibold px-2.5 p-1 w-full" placeholder="Input Course">
                    <template x-for="error in errors.course" class="w-fit">
                        <span x-text="error" class="text-xs text-rose-600 w-fit"></span><br>
                    </template>
                </div>
              </div>
              <!-- Modal footer -->
              <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b ">
                  <button id="SubmitAddCourse">Submit</button>
              </div>
          </div>
      </div>
  </div>
  