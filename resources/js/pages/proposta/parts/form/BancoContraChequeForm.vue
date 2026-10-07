<script setup>
import Card from '@/components/card/Card.vue';
import CardBody from '@/components/card/CardBody.vue';
import CardTitle from '@/components/card/CardTitle.vue';
import Input from '@/components/form/Input.vue';

const props = defineProps({
    formBancoContraque: Object,
    errors: {
        type: Object,
        default: () => ({}),
    },
})

</script>

<template>
    <Card>
        <CardBody>
            <CardTitle title="Dados bancários do contra cheque"
                icon="Landmark" />

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-2">
                <Input label="Código do banco"
                    v-model="formBancoContraque.banco"
                    :error="errors['bancoContraCheque.banco']"
                    :maxlength="10"
                    required />
                <Input label="Agência"
                    v-model="formBancoContraque.agencia"
                    :error="errors['bancoContraCheque.agencia']"
                    :maxlength="10"
                    required />

                <Input label="Conta"
                    v-model="formBancoContraque.conta"
                    :error="errors['bancoContraCheque.conta']"
                    :maxlength="25"
                    required />
            </div>
        </CardBody>
    </Card>
</template>