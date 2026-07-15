<script setup>
import AppLayout from '@/layout/AppLayout.vue';
import PageHeader from '@/layout/parts/AppLayout/PageHeader.vue';
import Filtro from './parts/index/Filtro.vue';
import Tabela from './parts/index/Tabela.vue';

defineProps({
    propostas: Array|Object,
    origens: Array,
    statusProposta: Array,
    filtros: Object,
})
</script>
<template>
    <AppLayout>
        <PageHeader title="Propostas"
            sub-title="Acompanhe suas propostas"
            icon="file-lines" />

        <Filtro :origens="origens" :statusProposta="statusProposta" :filtros="filtros" />

        <Tabela :propostas="propostas" />
    </AppLayout>
</template>