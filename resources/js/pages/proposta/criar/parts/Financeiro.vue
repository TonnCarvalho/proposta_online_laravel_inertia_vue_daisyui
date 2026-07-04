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
                    required />

                <Input label="Data da proposta"
                    v-model="formFinanceiro.data_proposta"
                    required />

                <Input label="Valor financiado"
                    v-model="formFinanceiro.valor_financiado"
                    :maxlength="10"
                    :mask="maskMoney"
                    required />

                <Input label="Valor liberado"
                    v-model="formFinanceiro.valor_liberado"
                    :maxlength="10"
                    :mask="maskMoney" />

                <Input label="Valor da parcela"
                    v-model="formFinanceiro.valor_parcela"
                    :maxlength="10"
                    :mask="maskMoney"
                    required />

                <Input label="Valor da mensalidade"
                    v-model="formFinanceiro.valor_mensalidade"
                    :maxlength="10"
                    :mask="maskMoney"
                    required />

                <Input label="Prazo"
                    :maxlength="3"
                    v-model="formFinanceiro.prazo"
                    required />

                <Select label="Tipo da proposta"
                    v-model="formFinanceiro.tipo_proposta"
                    placeholder="Selecione"
                    :items="tipoProposta"
                    :labelKey="item => item.label"
                    :valueKey="item => item.value" />

                <Input label="IOF"
                    v-model="formFinanceiro.iof"
                    :maxlength="10"
                    :mask="maskMoney"
                    required />

                <Input label="Taxa"
                    v-model="formFinanceiro.taxa"
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