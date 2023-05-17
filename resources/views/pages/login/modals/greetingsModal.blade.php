
  <!-- Main modal -->
  <div 
  x-show="modalType === 'greetingsModal'" x-transition:enter="transition duration-1000 transform origin-center"
  x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
  x-transition:leave="transition duration-1000"
  x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0 delay-100" tabindex="-1" aria-hidden="true" class=" backdrop-blur-sm bg-gray-500/50  flex items-center justify-center fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-full max-h-full">
      <div class="relative w-[30rem]">
          <!-- Modal content -->
          <div 
            x-show="modalType === 'greetingsModal'" x-transition:enter="transition delay-100 duration-1000 transform origin-center"
            x-transition:enter-start="scale-0" x-transition:enter-end="scale-100"
            x-transition:leave="transition duration-1000 transform origin-center"
            x-transition:leave-start="scale-100" x-transition:leave-end="scale-0"
            class="relative bg-transparent text-white">
              <!-- Modal body -->
              <div class="p-6">
                <p class=" text-4xl text-center font-black drop-shadow-lg">Welcome to Web based on the Job Training</p>
              </div>
              <!-- Modal footer -->
              <div class="flex items-center justify-center p-6 space-x-2 rounded-b ">
                  <button x-on:click="handleCloseModal()" class="animate-bounce px-2.5 py-2 rounded-lg bg-red-500 font-bold text-white">Login to Continue</button>
              </div>
          </div>
      </div>
  </div>
  