<script setup>
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
import { computed } from 'vue';

const props = defineProps({
    status: {
        type: Number,
        required: true,
    }
})
/**
 * Esse arquivo é usado para mostrar os status da proposta nos componentes de View
 * Usado em tabelas.
 */

const statusProposta = {
    0: {
        label: 'Recusada',
        class: 'bg-red-100 text-red-600 border-red-100',
        icon: FileX,
    },
    1: {
        label: 'Em andamento',
        class: 'bg-blue-100 text-blue-600 border-blue-100',
        icon: Loader,
    },
    2: {
        label: 'Em analise',
        class: 'bg-purple-100 text-purple-600 border-purple-100',
        icon: FileClock,
    },
    3: {
        label: 'Pendente',
        class: 'bg-yellow-100 text-yellow-500 border-yellow-100',
        icon: FileExclamationPoint,
    },
    4: {
        label: 'Pendencia resolvida',
        class: 'bg-cyan-100 text-cyan-500 border-cyan-100',
        icon: FileMinus,
    },
    5: {
        label: 'Conferida',
        class: 'bg-green-100 text-green-500 border-green-100',
        icon: FileCheck,
    },
    6: {
        label: 'Aguardando assinatura',
        class: 'bg-sky-100 text-sky-600 border-sky-100',
        icon: FilePenLine,
    },
    7: {
        label: 'Contrato assinado',
        class: 'bg-emerald-100 text-emerald-600 border-emerald-100',
        icon: FileCheckCorner,
    },
    8: {
        label: 'Assinatura CCB',
        class: 'bg-gray-100 text-gray-600 border-gray-100',
        icon: FileText,
    },
    9: {
        label: 'Aguardando pagamento',
        class: 'bg-indigo-100 text-indigo-500 border-indigo-100',
        icon: DollarSign,
    },
    10: {
        label: 'Pago',
        class: 'bg-green-100 text-green-700 border-green-100',
        icon: BadgeCheck,
    },
}

const statusConfig = computed(() => {
    return statusProposta[props.status] || {
        label: 'Desconhecido',
        background: '#E5E7EB',
        border: '#E5E7EB',
        color: '#374151',
        icon: ' fa-question',
    }
})
</script>

<template>
    <span class="badge whitespace-nowrap"
        :class="statusConfig.class">

        <component :is="statusConfig.icon"
            class="size-4" />

        {{ statusConfig.label }}
    </span>
</template>