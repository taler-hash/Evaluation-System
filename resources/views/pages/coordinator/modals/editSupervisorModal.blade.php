
  <!-- Main modal -->
  <div 
  x-cloak
  x-show="modalType === 'editSupervisorModal'" x-transition:enter="transition duration-200 transform origin-center"
  x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
  x-transition:leave="transition duration-200"
  x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0 delay-100" tabindex="-1" aria-hidden="true" class=" bg-gray-400/50  flex justify-center fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-full max-h-full">
      <div class="relative w-[30rem] h-full">
          <!-- Modal content -->
          <div 
            x-show="modalType === 'editSupervisorModal'" x-transition:enter="transition delay-100 duration-200 transform origin-center"
            x-transition:enter-start="scale-0" x-transition:enter-end="scale-100"
            x-transition:leave="transition duration-200 transform origin-center"
            x-transition:leave-start="scale-100" x-transition:leave-end="scale-0"
            class="relative bg-white rounded-lg shadow">
              <!-- Modal header -->
              <div class="flex items-start justify-between p-4 border-b rounded-t ">
                  <h3 class="text-xl font-semibold text-gray-900 ">
                      Add New Supervisor
                  </h3>
                  <button x-on:click="handleModal('')" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="defaultModal">
                      <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                      <span class="sr-only">Close modal</span>
                  </button>
              </div>
              <!-- Modal body -->
              <div class="p-6">
                <div class="space-y-2 mb-2">
                    <p for="" class="">Full name Format(f, m, l)<span class="text-red-500">*</span></p>
                    <input x-model="input.full_name" type="text" class="rounded-md border border-gray-400 bg-gray-50 font-semibold px-2.5 p-1 w-full" placeholder="Input Firstname">
                    <template x-for="error in errors.full_name" class="w-fit">
                        <span x-text="error" class="text-xs text-rose-600 w-fit"></span><br>
                    </template>
                </div>
                <div class="space-y-2 mb-2">
                    <p for="" class="">Company name<span class="text-red-500">*</span></p>
                    <input x-model="input.company_name" type="text" class="rounded-md border border-gray-400 bg-gray-50 font-semibold px-2.5 p-1 w-full" placeholder="Input Company Name">
                    <template x-for="error in errors.company_name" class="w-fit">
                        <span x-text="error" class="text-xs text-rose-600 w-fit"></span></br>
                    </template>
                </div>
                <div class="space-y-2 mb-2">
                    <p for="" class="">Position<span class="text-red-500">*</span></p>
                    <input x-model="input.company_position" type="text" class="rounded-md border border-gray-400 bg-gray-50 font-semibold px-2.5 p-1 w-full" placeholder="Input Position">
                    <template x-for="error in errors.company_position" class="w-fit">
                        <span x-text="error" class="text-xs text-rose-600 w-fit"></span><br>
                    </template>
                </div>
                <div class="space-y-2 mb-2">
                    <p for="" class="">Contact Number<span class="text-red-500">*</span></p>
                    <input x-model="input.contact_number" type="number" class="rounded-md border border-gray-400 bg-gray-50 font-semibold px-2.5 p-1 w-full" placeholder="Input Contact Number">
                    <template x-for="error in errors.contact_number" class="w-fit">
                        <span x-text="error" class="text-xs text-rose-600 w-fit"></span><br>
                    </template>
                </div>
                <div class="space-y-2 mb-2">
                    <p for="" class="">Email <span class="text-red-500">*</span></p>
                    <input x-model="input.email" type="text" class="rounded-md border border-gray-400 bg-gray-50 font-semibold px-2.5 p-1 w-full" placeholder="Input Email">
                    <template x-for="error in errors.email" class="w-fit">
                        <span x-text="error" class="text-xs text-rose-600 w-fit"></span><br>
                    </template>
                </div>
                <div class="space-y-2 mb-2">
                    <p for="" class="">Generated Username <span class="text-red-500">*</span></p>
                    <input readonly x-model="input.user_name" type="text" class="rounded-md border border-gray-400 bg-gray-50 font-semibold px-2.5 p-1 w-full" placeholder="Generated Username">
                    <template x-for="error in errors.user_name" class="w-fit">
                        <span x-text="error" class="text-xs text-rose-600 w-fit"></span><br>
                    </template>
                </div>
                <div class="space-y-2 mb-2">
                    <p for="" class="">Password <span class="text-red-500">*</span></p>
                    <div class="flex">
                        <input x-model="input.password" x-bind:type="canSee ? 'text' : 'password'"   class="rounded-md border border-gray-400 bg-gray-50 font-semibold px-2.5 p-1 w-full" placeholder="Input Password">
                        <button x-on:click="handleCanSee" class="pl-1">
                            <svg x-show="canSee" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                              </svg>
                              <svg x-show="!canSee" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                              </svg>
                        </button>
                    </div>
                    <template x-for="error in errors.password" class="w-fit">
                        <span x-text="error" class="text-xs text-rose-600 w-fit"></span><br>
                    </template>
                </div>
              </div>
              <!-- Modal footer -->
              <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b ">
                  <button id="SubmitEditSupervisor">Submit</button>
              </div>
          </div>
      </div>
  </div>
  