<script setup>

import AppLayout from '@/layout/AppLayout.vue';
import PageHeader from '@/layout/parts/AppLayout/PageHeader.vue';
import Tabela from './index/Tabela.vue';
import Filtro from './index/Filtro.vue';

const props = defineProps({
    propostas: Object,
    statusProposta: Array,
    tipoProposta: Array,
})

</script>
<template>
    <AppLayout>
        <PageHeader title="Acompanhamento"
            sub-title="Acompanhe e gerencie todas as propostas." />

        <!-- TAB -->

        <Filtro :statusProposta="props.statusProposta"
            :tipoProposta="props.tipoProposta" />

        <Tabela :propostas="props.propostas" />
    </AppLayout>
</template>