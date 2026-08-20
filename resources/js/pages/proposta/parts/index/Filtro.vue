<script setup>
import Card from '@/components/card/Card.vue';
import CardBody from '@/components/card/CardBody.vue';
import CardTitle from '@/components/card/CardTitle.vue';
import Input from '@/components/form/Input.vue';
import Select from '@/components/form/Select.vue';
import { router } from '@inertiajs/vue3';
import { watch, reactive } from 'vue';

const props = defineProps({
    origens: Array,
    statusProposta: Array,
    filtros: Object,
})

const filtros = reactive({
    search: props.filtros.search ?? '',
    origem: props.filtros.origem ?? '',
    status: props.filtros.status ?? '',
});

const limparFiltros = (filtros) => {
    const query = { ...filtros };
    Object.keys(query).forEach((key) => {
        if (
            query[key] === '' ||
            query[key] === null ||
            query[key] === undefined
        ) {
            delete query[key];
        }
    })
    return query;
}

watch(
    filtros,
    () => {
        router.get(
            '/proposta',
            limparFiltros(filtros),
            {
                preserveScroll: true,
                preserveState: true,
                replace: true,
            }
        );
    },
    {
        deep: true
    }
);

</script>

<template>
    <Card>
        <CardBody>
            <CardTitle title="Filtro"
                icon="SlidersHorizontal" />

            <div class="grid grid-cols-1 md:grid-cols-3 items-center gap-3">
                <Input label="Pesquisa"
                    placeholder="Nome do associado ou Nº da proposta"
                    type="search"
                    v-model="filtros.search" />

                <Select label="Praça"
                    placeholder="Selecione"
                    v-model="filtros.origem"
                    :items="origens"
                    :valueKey="item => item.cod_local"
                    :labelKey="item => item.nome" />

                <Select label="Situação"
                    placeholder="Selecione"
                    v-model="filtros.status"
                    :items="statusProposta"
                    :labelKey="item => item.label"
                    :valueKey="item => item.value" />
            </div>
        </CardBody>
    </Card>

</template>