import { FileXCorner, FilePenLine, FileCheckCorner } from '@lucide/vue'

export const listaStatusAssinatura = [
    {
        id: 1,
        label: 'Não enviado',
        icon: FileXCorner,
        cor: 'bg-red-600 text-white border-red-600',
    },
    {
        id: 2,
        label: 'Aguardando assinatura',
        icon: FilePenLine,
        cor: 'bg-sky-600 text-white border-sky-600',
    },
    {
        id: 3,
        label: 'Assinado',
        icon: FileCheckCorner,
        cor: 'bg-emerald-600 text-white border-emerald-600',
    },
]

// Devolve o status completo a partir do id (ou undefined se não existir)
export function buscarStatus(id) {
    return listaStatusAssinatura.find((status) => status.id === id)
}