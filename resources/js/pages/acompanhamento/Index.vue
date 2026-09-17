<script setup>

import AppLayout from '@/layout/AppLayout.vue';
import PageHeader from '@/layout/parts/AppLayout/PageHeader.vue';
import Tabela from './index/Tabela.vue';
import Filtro from './index/Filtro.vue';
import Pagination from '@/components/Pagination.vue';

const props = defineProps({
    propostas: Object,
    statusProposta: Array,
    tipoProposta: Array,
    pracaAtiva: Array,
    filtros: Object,
})

</script>
<template>
    <AppLayout>
        <PageHeader title="Acompanhamento"
            sub-title="Acompanhe e gerencie todas as propostas." />

        <!-- TAB -->

        <Filtro :statusProposta="props.statusProposta"
            :tipoProposta="props.tipoProposta"
            :pracaAtiva="props.pracaAtiva"
            :filtros="filtros" />

        <Tabela :propostas="props.propostas" />

        <Pagination :paginator="propostas" />
    </AppLayout>
</template>