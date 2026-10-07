<script setup>
import Card from '@/components/card/Card.vue';
import CardBody from '@/components/card/CardBody.vue';
import Input from '@/components/form/Input.vue';
import Select from '@/components/form/Select.vue';
import { Funnel, FunnelPlus, Search } from '@lucide/vue';
import { router } from '@inertiajs/vue3';
import { reactive, ref } from 'vue';

const props = defineProps({
    statusProposta: Array,
    tipoProposta: Array,
    pracaAtiva: Array,
    filtros: Object,
})

const assinatura = [
    { label: 'Não enviado', value: 1 },
    { label: 'Aguardando assinatura', value: 2 },
    { label: 'Assinado', value: 3 },
]

let maisFiltros = ref(false);

const filtros = reactive({
    pesquisa: props.filtros.pesquisa ?? '',
    corretor: props.filtros.corretor ?? '',
    situacao: props.filtros.situacao ?? '',
    assinatura: props.filtros.assinatura ?? '',
    origem: props.filtros.origem ?? '',
    tipo: props.filtros.tipo ?? '',
})


const removerFiltrosVazios = (filtros) => {
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
const search = () => {
    router.get(route('acompanhamento.index'),
        removerFiltrosVazios(filtros), {
        preserveState: true,
        preserveScroll: true,
    }
    )
}

</script>
<template>
    <Card class="mb-3">
        <CardBody>
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-3">

                <Input label="Pesquisa"
                    v-model="filtros.pesquisa"
                    type="search"
                    placeholder="Associado | CPF | N° Proposta" />

                <Input label="Corretor"
                    v-model="filtros.corretor"
                    type="search"
                    placeholder="Código" />

                <Select label="Situação"
                    placeholder="Todas propostas"
                    v-model="filtros.situacao"
                    :items="statusProposta"
                    :labelKey="item => item.label"
                    :valueKey="item => item.value" />

                <Select label="Assinatura"
                    placeholder="Todos"
                    v-model="filtros.assinatura"
                    :items="assinatura"
                    :labelKey="item => item.label"
                    :valueKey="item => item.value" />
            </div>

            <div v-show="maisFiltros === true"
                class="grid grid-cols-1 lg:grid-cols-4 gap-3">

                <Select label="Praça"
                    placeholder="Todas praças"
                    v-model="filtros.origem"
                    :items="pracaAtiva"
                    :labelKey="item => item.nome"
                    :valueKey="item => item.cod_local" />

                <Select label="Tipo da proposta"
                    placeholder="Todos tipos"
                    v-model="filtros.tipo"
                    :items="tipoProposta"
                    :labelKey="item => item.label"
                    :valueKey="item => item.value" />
            </div>

            <div class="">
                <button @click="search()"
                    class="btn btn-primary w-50 mr-3">
                    <Search size="15" />
                    Buscar
                </button>

                <button @click="maisFiltros = !maisFiltros"
                    class="btn btn-primary btn-soft">

                    <span v-if="maisFiltros === false"
                        class="flex items-center gap-1">
                        <FunnelPlus size="15" />
                        Mais filtros
                    </span>

                    <span v-else
                        class="flex items-center gap-1">
                        <Funnel size="15" />
                        Menos filtros
                    </span>
                </button>
            </div>
        </CardBody>
    </Card>
</template>