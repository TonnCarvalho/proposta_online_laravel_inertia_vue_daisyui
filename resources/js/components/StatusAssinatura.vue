<script setup>
import { FileXCorner, FilePenLine, FileCheckCorner } from '@lucide/vue';
import { computed } from 'vue';

const props = defineProps({
    status: {
        type: Number,
        required: true,
    }
})

//Configuração do status.
const statusMap = {

    1: {
        label: 'Não enviado',
        background: '#FEE2E2',
        color: '#991B1B',
        icon: FileXCorner,
    },
    2: {
        label: 'Aguardando assinatura',
        background: '#DBEAFE',
        color: '#1E40AF',
        icon: FilePenLine,
    },
    3: {
        label: 'Assinado',
        background: '#D1FAE5',
        color: '#065F46',
        icon: FileCheckCorner,
    },
}

const statusConfig = computed(() => {
    return statusMap[props.status]
})
</script>

<template>
    <span class="badge whitespace-nowrap"
        :style="{
            backgroundColor: statusConfig.background,
            color: statusConfig.color,
        }">

        <component :is="statusConfig.icon" :size="15"  />

        {{ statusConfig.label }}
    </span>
</template>