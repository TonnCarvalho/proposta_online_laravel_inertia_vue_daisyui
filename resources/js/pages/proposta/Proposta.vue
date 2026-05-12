<script setup>
import AppLayout from '@/layout/AppLayout.vue';
import PageHeader from '@/layout/parts/AppLayout/PageHeader.vue';
import Filtro from './parts/proposta/Filtro.vue';
import Tabela from './parts/proposta/Tabela.vue';

defineProps({
    propostas: Array|Object,
    origens: Array,

})
</script>
<template>
    <AppLayout>
        <PageHeader title="Propostas"
            sub-title="Acompanhe suas propostas"
            icon="file-lines" />

        <Filtro :origens="origens" />

        <Tabela :propostas="propostas" />
    </AppLayout>
</template>