<script setup>


import AppLayout from '@/layout/AppLayout.vue';
import PageHeader from '@/layout/parts/AppLayout/PageHeader.vue';
import Pesquisa from './parts/Pesquisa.vue';
import Matriculas from './parts/Matriculas.vue';
import { ref } from 'vue';

const isRegistration = ref(false);
const matriculas = ref([]);

const mostrarMatriculas = (dados) => {
    matriculas.value = dados;
    isRegistration.value = dados.length > 0;
}
</script>
<template>
    <AppLayout>
        <PageHeader title="Pesquisa associado"
            icon="user"
            sub-title="Pesquise o associado e veja se ele possui matrículas" />

        <Pesquisa @resultado="mostrarMatriculas" />

        <Matriculas v-if="isRegistration"
            :matriculas="matriculas" />

    </AppLayout>
</template>