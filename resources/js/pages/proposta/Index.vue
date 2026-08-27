<script setup>
import AppLayout from '@/layout/AppLayout.vue';
import PageHeader from '@/layout/parts/AppLayout/PageHeader.vue';
import Filtro from './parts/index/Filtro.vue';
import Tabela from './parts/index/Tabela.vue';
import Alert from '@/components/Alert.vue';

const props = defineProps({
    propostas: Array | Object,
    origens: Array,
    statusProposta: Array,
    filtros: Object,
    alert: Object,
})
</script>
<template>
    <AppLayout>
        <PageHeader title="Propostas"
            sub-title="Acompanhe suas propostas"
            icon="file-lines" />

        <Alert v-if="alert?.message"
            icon="Ban"
            :message="alert?.message"
            :subMessage="alert?.subMessage"
            :type="alert?.type" />

        <Filtro :origens="origens"
            :statusProposta="statusProposta"
            :filtros="filtros" />

        <Tabela :propostas="propostas" />
    </AppLayout>
</template>