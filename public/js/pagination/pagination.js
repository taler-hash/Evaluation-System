function usePagination({id}){
    document.getElementById(id).innerHTML = `<ul class="flex justify-end">
    <template x-for="(link, i) in links">
        <li class="">
            <button
                x-on:click="handlePaginate(new URL(link.url).searchParams.get('page'))"
                x-bind:disabled='link.active || !link.url'
                class="p-1 px-2.5  border shadow-sm font-medium text-sm transition" 
                x-text="link.label"
                x-bind:class="[
                    (link.active || !link.url ? 'bg-gray-50 ' : 'hover:bg-red-500 hover:text-white'),
                    (i === 0 ? 'rounded-l-lg' : i === links.length - 1 ? 'rounded-r-lg' :''), 
                    (link.active ? 'bg-red-500 text-white' : 'bg-white')
                ]"
            ></button>
        </li>
    </template>
</ul>`
}