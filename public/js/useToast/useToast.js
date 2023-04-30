
function useToast({message, type})
{
    let color = 
        type ===  'error' ? 'red-500' :
        type === 'info' ? 'sky-700' : 
        type === 'warning' ? 'amber-600':
        'green-600'
 Toastify({
    text: message,
    duration: 404400,
    close: true,
    className: `border-l-4 border-${color} text-gray-700 font-bold shadow-md`,
    style: {
        background: "white",
    },
    }).showToast()
}