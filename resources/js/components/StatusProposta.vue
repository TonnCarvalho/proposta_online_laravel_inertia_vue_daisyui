<script setup>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { computed } from 'vue';

const props = defineProps({
    status: {
        type: Number,
        required: true,
    }
})

//Configuração do status.
const statusMap = {
    0: {
        label: 'Recusada',
        background: '#FEE2E2',
        border: '#FEE2E2',
        color: '#991B1B',
        icon: 'circle-xmark',
    },
    1: {
        label: 'Em andamento',
        background: '#DBEAFE',
        border: '#DBEAFE',
        color: '#1E40AF',
        icon: 'spinner',
    },
    2: {
        label: 'Em analise',
        background: '#F3E8FF',
        border: '#F3E8FF',
        color: '#8613e4',
        icon: 'file-lines',
    },
    3: {
        label: 'Pendente',
        background: '#FEF3C7',
        border: '#FEF3C7',
        color: '#da5e13',
        icon: 'circle-exclamation',
    },
    4: {
        label: 'Pendencia resolvida',
        background: '#FFEDD5',
        border: '#FFEDD5',
        color: '#9A3412',
        icon: 'circle-check',
    },
    5: {
        label: 'Conferida',
        background: '#CCFBF1',
        border: '#CCFBF1',
        color: '#115E59',
        icon: 'clipboard-check',
    },
    6: {
        label: 'Assinatura contrato',
        background: '#E0E7FF',
        border: '#E0E7FF',
        color: '#3730A3',
        icon: 'file-signature',
    },
    7: {
        label: 'Contrato assinado',
        background: '#E0E7FF',
        border: '#E0E7FF',
        color: '#3730A3',
        icon: 'check',
    },
    8: {
        label: 'Assinatura CCB',
        background: '#e7e7e7',
        border: '#e7e7e7',
        color: '#454545',
        icon: 'file-signature',
    },
    9: {
        label: 'Aguardando pagamento',
        background: '#e5ff95',
        border: '#e5ff95',
        color: '#454545',
        icon: 'dollar-sign',
    },
    10: {
        label: 'Pago',
        background: '#D1FAE5',
        border: '#D1FAE5',
        color: '#065F46',
        icon: 'dollar-sign',
    },
}

const statusConfig = computed(() => {
    return statusMap[props.status] || {
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
        :style="{
            backgroundColor: statusConfig.background,
            color: statusConfig.color,
            borderColor: statusConfig.border
        }">
        <FontAwesomeIcon :icon="statusConfig.icon"
            class="text-xs" />
        {{ statusConfig.label }}
    </span>
</template>