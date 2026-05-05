<script setup lang="ts">
import AppLayout from '@/layout/AppLayout.vue';
import PageHeader from '@/layout/parts/AppLayout/PageHeader.vue';
import Filtro from './parts/proposta/Filtro.vue';
import Tabela from './parts/proposta/Tabela.vue';

interface Associado {
    id: number,
    nome: string,
}
interface Origem {
    id: number,
    nome: string,
}
interface Proposta {
    id: number,
    num_proposta: number,
    status_proposta: number,
    created_at: string,
    associado: Associado,
    origem: Origem,
}

defineProps<{
    propostas: Proposta[]
}>()
</script>
<template>

    <AppLayout>
        <PageHeader title="Propostas"
            sub-title="Acompanhe suas propostas"
            icon="file-text" />

        <Filtro />
        <!-- <pre>
            {{ propostas }}
        </pre> -->
        <Tabela :propostas="propostas" />

    </AppLayout>
</template>