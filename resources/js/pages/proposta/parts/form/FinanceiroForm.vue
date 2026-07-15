<script setup>
import Card from '@/components/card/Card.vue';
import CardBody from '@/components/card/CardBody.vue';
import CardTitle from '@/components/card/CardTitle.vue';
import Input from '@/components/form/Input.vue';
import Select from '@/components/form/Select.vue';
import { maskMoney } from '@/utils/masks';

const props = defineProps({
    formFinanceiro: Object,
    tipoProposta: Array,
    fontePagamento: Array,
    errors: {
        typeof: Object,
        default: ({}),
    },
})

</script>

<template>
    <Card>
        <CardBody>
            <CardTitle title="Auxílio financeiro" />
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-2">

                <Input label="Código do corretor"
                    :maxlength="4"
                    v-model="formFinanceiro.cod_corretor"
                    :error="errors['financeiro.cod_corretor']"
                    required />

                <Input label="Data da proposta"
                    v-model="formFinanceiro.data_proposta"
                    :error="errors['financeiro.data_proposta']"
                    required />

                <Input label="Proposta"
                    v-if="formFinanceiro.num_proposta"
                    readonly
                    v-model="formFinanceiro.num_proposta"
                    :error="errors['financeiro.num_proposta']" />

                <Input label="Valor financiado"
                    v-model="formFinanceiro.valor_financiado"
                    :error="errors['financeiro.valor_financiado']"
                    :maxlength="10"
                    :mask="maskMoney"
                    required />

                <Input label="Valor liberado"
                    v-model="formFinanceiro.valor_liberado"
                    :maxlength="10"
                    :mask="maskMoney" />

                <Input label="Valor da parcela"
                    v-model="formFinanceiro.valor_parcela"
                    :error="errors['financeiro.valor_parcela']"
                    :maxlength="10"
                    :mask="maskMoney"
                    required />

                <Input label="Valor da mensalidade"
                    v-model="formFinanceiro.valor_mensalidade"
                    :error="errors['financeiro.valor_mensalidade']"
                    :maxlength="10"
                    :mask="maskMoney"
                    required />

                <Input label="Prazo"
                    :maxlength="3"
                    v-model="formFinanceiro.prazo"
                    :error="errors['financeiro.prazo']"
                    required />

                <Select label="Tipo da proposta"
                    v-model="formFinanceiro.tipo_proposta"
                    placeholder="Selecione"
                    :items="tipoProposta"
                    :labelKey="item => item.label"
                    :valueKey="item => item.value" />

                <Input label="IOF"
                    v-model="formFinanceiro.iof"
                    :error="errors['financeiro.iof']"
                    :maxlength="10"
                    :mask="maskMoney"
                    required />

                <Input label="Taxa"
                    v-model="formFinanceiro.taxa"
                    :error="errors['financeiro.taxa']"
                    :maxlength="4"
                    required />

                <Select label="Fonte pagamento"
                    v-model="formFinanceiro.fonte_pagamento"
                    placeholder="Selecione"
                    :items="fontePagamento"
                    :labelKey="item => item.fonte"
                    :valueKey="item => item.id" />
            </div>
        </CardBody>
    </Card>
</template>