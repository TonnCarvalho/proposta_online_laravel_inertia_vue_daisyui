<script setup>
import AppLayout from '@/layout/AppLayout.vue';
import PageHeader from '@/layout/parts/AppLayout/PageHeader.vue';
import Associado from './parts/Associado.vue';
import { useForm } from '@inertiajs/vue3';

defineProps({
    origens: Array|Object,
})
const form = useForm({
    associado: {
        nome: '',
        cod_local: '',
        cpf: '',
        rg: '',
        org_exp: '',
        email: '',
        data_nasc: '',
        nat: '',
        sexo: '',
        cel: '',
        nome_pai: '',
        nome_mae: '',
        estado_civil: '',
        mat: '',
        cod_orgao: '',
        setor: '',
        cargo: '',
        ocupacao: '',
        data_admissao: '',
    }
})
</script>
<template>
    <AppLayout>
        <PageHeader title="Nova proposta"
            icon="file-circle-plus" />

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
            <Associado :formAssociado="form.associado" :origens="origens" />

        </div>
    </AppLayout>
</template>