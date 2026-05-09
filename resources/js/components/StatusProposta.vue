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
    1: {
        label: 'Em andamento',
        background: '#DBEAFE',
        border: '#DBEAFE',
        color: '#1E40AF',
        icon: 'fas fa-spinner',
    }
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
    <!-- <span class="inline-flex items-center justify-center gap-1 px-3 py-1 text-sm font-medium rounded border whitespace-nowrap"
    :style="{
        backgroundColor: statusConfig.background,
        color: statusConfig.color,
        borderColor: statusConfig.border
    }"> -->
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