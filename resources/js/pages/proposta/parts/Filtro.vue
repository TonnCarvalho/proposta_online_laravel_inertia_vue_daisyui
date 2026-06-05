<script setup>
import Card from '@/components/card/Card.vue';
import CardBody from '@/components/card/CardBody.vue';
import CardHead from '@/components/card/cardHead.vue';
import Input from '@/components/form/Input.vue';
import Select from '@/components/form/Select.vue';
import { router } from '@inertiajs/vue3';
import { watch, reactive } from 'vue';

defineProps({
    origens: Array,
    statusProposta: Array,
})

const filters = reactive({
    search: '',
    origem: '',
    status: '',
})

watch(filters, () => {
    router.get('/proposta', filters, {
        preserveScroll: true,
        preserveState: true,
        replace: true
    })
},
    {
        deep: true
    }
);

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
                    v-model="filters.search" />

                <Select label="Praça"
                    placeholder="Selecione"
                    v-model="filters.origem"
                    :items="origens"
                    :valueKey="item => item.cod_local"
                    :labelKey="item => item.nome" />

                <Select label="Situação"
                    placeholder="Selecione"
                    v-model="filters.status"
                    :items="statusProposta"
                    :labelKey="item => item.label"
                    :valueKey="item => item.value" />
            </div>
        </CardBody>
    </Card>

</template>