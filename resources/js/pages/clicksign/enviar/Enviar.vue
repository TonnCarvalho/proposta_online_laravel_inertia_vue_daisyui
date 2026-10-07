<template>
    <AppLayout>
        <PageHeader title="Envio Click Sign"
            sub-title="Propostas prontas a serem enviada para assinatura" />

        <Tabela :propostas="props.propostas" />

    </AppLayout>
</template>

<script setup>
import AppLayout from '@/layout/AppLayout.vue';
import Tabela from './parts/Tabela.vue';
import PageHeader from '@/layout/parts/AppLayout/PageHeader.vue';

const props = defineProps({
    propostas: Array
})

</script>