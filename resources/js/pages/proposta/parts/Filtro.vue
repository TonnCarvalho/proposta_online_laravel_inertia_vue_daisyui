<script setup>
import Card from '@/components/card/Card.vue';
import CardBody from '@/components/card/CardBody.vue';
import CardHead from '@/components/card/cardHead.vue';
import Input from '@/components/form/Input.vue';
import Select from '@/components/form/Select.vue';
import { router } from '@inertiajs/vue3';
import { watch, ref } from 'vue';

defineProps({
    origens: Array,
})
const situacoes = [
    { label: 'Andamento', value: 'andamento' },
    { label: 'Andamento', value: 'andamento' },
    { label: 'Andamento', value: 'andamento' },
    { label: 'Andamento', value: 'andamento' },
]

const pesquisa = ref('');
const origem = ref('');
const situacao = ref('');

watch(pesquisa, (q) => router.get('/proposta',
    { search: q },
    {
        preserveState: true,
        preserveScroll: true
    },
));

</script>

<template>
    <Card>
        <CardHead title="Filtro"
            icon="filter" />
        <CardBody>
            <div class="grid grid-cols-1 md:grid-cols-3 items-center gap-3">
                <Input label="Pesquisa"
                    placeholder="nome do associado ou nº da proposta"
                    type="search"
                    v-model="pesquisa" />

                <Select label="Praça"
                    placeholder="Selecione"
                    v-model="origem"
                    :items="origens"
                    :valueKey="item => item.id"
                    :labelKey="item => item.nome" />

                <Select label="Situação"
                    placeholder="Selecione"
                    v-model="situacao"
                    :items="situacoes"
                    :valueKey="item => item.value"
                    :labelKey="item => item.label" />
            </div>
        </CardBody>
    </Card>

</template>