<script setup>
import { FileXCorner, FilePenLine, FileCheckCorner } from '@lucide/vue';
import { computed } from 'vue';

const props = defineProps({
    status: {
        type: Number,
    }
})

//Configuração do status.
const statusMap = {

    1: {
        label: 'Não enviado',
        class: 'bg-red-100 text-red-600 border-red-100',
        icon: FileXCorner,
    },
    2: {
        label: 'Aguardando assinatura',
        class: 'bg-sky-100 text-sky-600 border-sky-100',
        icon: FilePenLine,
    },
    3: {
        label: 'Assinado',
        class: 'bg-emerald-100 text-emerald-600 border-emerald-100',
        icon: FileCheckCorner,
    },
}

const statusConfig = computed(() => {
    return statusMap[props.status]
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