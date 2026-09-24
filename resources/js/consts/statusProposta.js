/**
 * Esse arquivo é usado nos componentes de mudança de status da proposta.
 */

import {
    BadgeCheck,
    DollarSign,
    FileCheck,
    FileCheckCorner,
    FileClock,
    FileExclamationPoint,
    FileMinus,
    FilePenLine,
    FileText,
    FileX,
    Loader
} from '@lucide/vue';

// Ao alterar o id desse arquivo, altere o valor do App/Enum/StatusProposta
export const listaStatusProposta = [
    {
        id: 0,
        label: 'Recusada',
        class: 'bg-red-600 text-white border-red-600',
        icon: FileX,
    },
    {
        id: 1,
        label: 'Em andamento',
        class: 'bg-blue-600 text-white border-blue-600',
        icon: Loader,
    },
    {
        id: 2,
        label: 'Em analise',
        class: 'bg-purple-600 text-white border-purple-600',
        icon: FileClock,
    },
    {
        id: 3,
        label: 'Pendente',
        class: 'bg-yellow-500 text-white border-yellow-500',
        icon: FileExclamationPoint,
    },
    {
        id: 4,
        label: 'Pendencia resolvida',
        class: 'bg-cyan-500 text-white border-cyan-500',
        icon: FileMinus,
    },
    {
        id: 5,
        label: 'Conferida',
        class: 'bg-green-500 text-white border-green-500',
        icon: FileCheck,
    },
    {
        id: 6,
        label: 'Aguardando assinatura',
        class: 'bg-sky-600 text-white border-sky-600',
        icon: FilePenLine,
    },
    {
        id: 7,
        label: 'Contrato assinado',
        class: 'bg-emerald-600 text-white border-emerald-600',
        icon: FileCheckCorner,
    },
    {
        id: 8,
        label: 'Assinatura CCB',
        class: 'bg-gray-600 text-white border-gray-600',
        icon: FileText,
    },
    {
        id: 9,
        label: 'Aguardando pagamento',
        class: 'bg-indigo-500 text-white border-indigo-500',
        icon: DollarSign,
    },
    {
        id: 10,
        label: 'Pago',
        class: 'bg-green-700 text-white border-green-700',
        icon: BadgeCheck,
    },
]

// Devolve o status completo a partir do id (ou undefined se não existir)
export function buscarStatus(id) {
    return listaStatusProposta.find((status) => status.id === id)
}