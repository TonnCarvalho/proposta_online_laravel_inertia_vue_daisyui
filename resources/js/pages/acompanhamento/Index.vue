<script setup>

import AppLayout from '@/layout/AppLayout.vue';
import PageHeader from '@/layout/parts/AppLayout/PageHeader.vue';
import Tabela from './index/Tabela.vue';

const props = defineProps({
    propostas: Object,

})
</script>
<template>
    <AppLayout>
        <PageHeader title="Acompanhamento"
            sub-title="Acompanhe e gerencie todas as propostas." />

        <!-- TAB -->
        <!-- FILTRO -->
        <!-- TABEL -->
        <Tabela :propostas="props.propostas" />
    </AppLayout>
</template>