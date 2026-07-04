<script setup>
import Card from '@/components/card/Card.vue';
import CardBody from '@/components/card/CardBody.vue';
import CardTitle from '@/components/card/CardTitle.vue';
import Input from '@/components/form/Input.vue';
import { ref } from 'vue';

const props = defineProps({
    formBancoContraque: Object,
})

</script>

<template>
    <Card>
        <CardBody>
            <CardTitle title="Dados bancários do contra cheque" />


            <div class="grid grid-cols-1 lg:grid-cols-2 gap-2">
                <Input label="Código do banco"
                    v-model="formBancoContraque.banco"
                    :maxlength="10"
                    required />
                <Input label="Agência"
                    v-model="formBancoContraque.agencia"
                    :maxlength="10"
                    required />

                <Input label="Conta"
                    v-model="formBancoContraque.conta"
                    :maxlength="25"
                    required />
            </div>
        </CardBody>
    </Card>
</template>