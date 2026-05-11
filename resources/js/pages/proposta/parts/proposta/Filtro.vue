<script setup>
import Card from '@/components/card/Card.vue';
import CardBody from '@/components/card/CardBody.vue';
import CardHead from '@/components/card/cardHead.vue';
import Input from '@/components/form/Input.vue';
import Select from '@/components/form/Select.vue';
import { router, useForm } from '@inertiajs/vue3';

defineProps({
    origens: Array,
})

const form = useForm({
    search: '',
    origem: '',
    situacao: '',
})
const search = () => {
    router.get(route('proposta.index'), { search: form.search })
}
const situacao = [
    { label: 'Andamento', value: 'andamento' },
    { label: 'Andamento', value: 'andamento' },
    { label: 'Andamento', value: 'andamento' },
    { label: 'Andamento', value: 'andamento' },
]
</script>

<template>
    <Card>
        <CardHead title="Filtro"
            icon="filter" />
        <CardBody>
            <div class="grid grid-cols-1 md:grid-cols-3 items-center gap-3">
                <form @submit.prevent="search()">
                    <Input label="Pesquisa"
                        placeholder="Nome ou Nº proposta"
                        type="search"
                        v-model="form.search" />
                </form>

                <Select label="Praça"
                    placeholder="Selecione"
                    v-model="form.origem"
                    :items="origens"
                    :valueKey="item => item.id"
                    :labelKey="item => item.nome" />

                <Select label="Situação"
                    placeholder="Selecione"
                    v-model="form.situacao"
                    :items="situacao"
                    :valueKey="item => item.value"
                    :labelKey="item => item.label" />
            </div>
        </CardBody>
    </Card>

</template>