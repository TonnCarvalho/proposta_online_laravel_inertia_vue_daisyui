<script setup>
import Card from '@/components/card/Card.vue';
import CardBody from '@/components/card/CardBody.vue';
import CardTitle from '@/components/card/CardTitle.vue';
import Input from '@/components/form/Input.vue';
import Select from '@/components/form/Select.vue';

const props = defineProps({
    formFinanceiro: Object,
    tipoProposta: Array,
})

</script>

<template>
    <Card>
        <CardBody>
            <CardTitle title="Auxílio Financeiro" />
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-2">

                <Input label="Código do corretor"
                    :maxlength="4"
                    required />

                <Input label="Data da proposta"
                    required />

                <Input label="Valor financiado"
                    required />

                <Input label="Valor liberado" />

                <Input label="Valor da parcela"
                    required />

                <Input label="Valor da mensalidade"
                    required />

                <Input label="Prazo"
                    required />

                <Select label="Tipo da proposta" 
                placeholder="Selecione"
                :items="tipoProposta"
                :labelKey="item => item.label"
                :valueKey="item => item.value"
                />

                <Input label="IOF"
                    required />

                <Input label="Taxa"
                    required />

                <Select label="Fonte pagamento" />

            </div>
        </CardBody>
    </Card>
</template>