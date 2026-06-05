<script setup>
import AppLayout from '@/layout/AppLayout.vue';
import PageHeader from '@/layout/parts/AppLayout/PageHeader.vue';
import Filtro from './parts/Filtro.vue';
import Tabela from './parts/Tabela.vue';

defineProps({
    propostas: Array|Object,
    origens: Array,
    statusProposta: Array,
})
</script>
<template>
    <AppLayout>
        <PageHeader title="Propostas"
            sub-title="Acompanhe suas propostas"
            icon="file-lines" />

        <Filtro :origens="origens" :statusProposta="statusProposta" />

        <Tabela :propostas="propostas" />
    </AppLayout>
</template>