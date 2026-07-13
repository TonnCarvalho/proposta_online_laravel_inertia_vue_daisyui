<script setup>
import Card from '@/components/card/Card.vue';
import CardBody from '@/components/card/CardBody.vue';
import CardTitle from '@/components/card/CardTitle.vue';
import Input from '@/components/form/Input.vue';
import Select from '@/components/form/Select.vue';


const props = defineProps({
    formBancoRecimento: Object,
    errors: {
        type: Object,
        default: () => ({}),
    },
})

const tipoConta = [
    { label: 'Corrente', value: 'C' },
    { label: 'Poupança', value: 'P' },
]
</script>

<template>
    <Card>
        <CardBody>
            <CardTitle title="Conta bancária para recebimento" />

            <Input label="Chave Pix"
                v-model="formBancoRecimento.chave_pix"
                :maxlength="100" />

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-2">
                <Input label="Código do banco"
                    v-model="formBancoRecimento.banco_pagamento"
                    :error="errors['bancoRecebimento.banco_pagamento']"
                    :maxlength="10"
                    required />

                <Input label="Agência"
                    v-model="formBancoRecimento.agencia_pagamento"
                    :error="errors['bancoRecebimento.agencia_pagamento']"
                    :maxlength="10"
                    required />

                <Input label="Conta"
                    v-model="formBancoRecimento.conta_pagamento"
                    :error="errors['bancoRecebimento.conta_pagamento']"
                    :maxlength="25"
                    required />

                <Select label="Tipo de Conta"
                    v-model="formBancoRecimento.tipo_bancario"
                    placeholder="Selecione o tipo"
                    :items="tipoConta"
                    :labelKey="item => item.label"
                    :valueKey="item => item.value" />
            </div>
        </CardBody>
    </Card>
</template>