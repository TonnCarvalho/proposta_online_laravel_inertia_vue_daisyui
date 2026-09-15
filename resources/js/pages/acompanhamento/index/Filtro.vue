<script setup>
import Card from '@/components/card/Card.vue';
import CardBody from '@/components/card/CardBody.vue';
import Input from '@/components/form/Input.vue';
import Select from '@/components/form/Select.vue';
import { Funnel, FunnelPlus, Search } from '@lucide/vue';
import { ref } from 'vue';

const props = defineProps({
    statusProposta: Array,
    tipoProposta: Array,
})

const assinatura = [
    { label: 'Não enviado', value: 1 },
    { label: 'Aguardando assinatura', value: 2 },
    { label: 'Assinado', value: 3 },
]

const maisFiltros = ref(false);

</script>
<template>
    <Card class="mb-3">
        <CardBody>
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-3">
                <Input label="Pesquisa"
                    placeholder="Associado | CPF | N° Proposta" />

                <Input label="Corretor"
                    placeholder="Nome | Código" />

                <Select label="Situação"
                    placeholder="Todos"
                    :items="statusProposta"
                    :labelKey="item => item.label"
                    :valueKey="item => item.value" />

                <Select label="Assinatura"
                    placeholder="Todos"
                    :items="assinatura"
                    :labelKey="item => item.label"
                    :valueKey="item => item.value" />
            </div>

            <div v-if="maisFiltros === true"
                class="grid grid-cols-1 lg:grid-cols-4 gap-3">
                <Select label="Praça"
                    placeholder="Todos"
                    :items="assinatura"
                    :labelKey="item => item.label"
                    :valueKey="item => item.value" />

                <Select label="Tipo da proposta"
                    placeholder="Todos"
                    :items="tipoProposta"
                    :labelKey="item => item.label"
                    :valueKey="item => item.value" />
            </div>

            <div class="">
                <button class="btn btn-primary w-50 mr-3">
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