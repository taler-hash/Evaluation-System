function loadingButton({id,label, onClick, param, width, color})
{
    const button = document.createElement("button");
    button.setAttribute('x-on:click.stop', onClick)
    button.setAttribute('x-bind:disabled', `${param}`)
    button.setAttribute('x-html', `${param} ? '<span>Loading</span>' : '${label}'`)
    button.setAttribute('class',`bg-${color}-800 transition hover:bg-${color}-600 py-2 px-4 rounded-lg text-white font-bold w-${width}`)

    document.getElementById(id).replaceWith(button)
}