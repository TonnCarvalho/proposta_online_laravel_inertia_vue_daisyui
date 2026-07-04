<script setup>
import Card from '@/components/card/Card.vue';
import CardBody from '@/components/card/CardBody.vue';
import CardTitle from '@/components/card/CardTitle.vue';
import Input from '@/components/form/Input.vue';
import { ref } from 'vue';

const props = defineProps({
    formEndereco: Object,
})

const erroCep = ref('');

const limparSomenteNumeros = (value) => {
    return value.replace(/\D/g, '')
}
const buscarCep = async () => {
    erroCep.value = '';

    const cep = limparSomenteNumeros(props.formEndereco.cep);

    if (cep.length !== 8) {
        erroCep.value = 'CEP inválido. Informe 8 números'
        return;
    }

    try {

        const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`)

        if (!response.ok) {
            erroCep.value = 'Erro ao consultar o CEP.'
            return;
        }

        const data = await response.json();

        if (data.erro) {
            erroCep.value = 'CEP não encontrado';
            return;
        }

        props.formEndereco.cep = data.cep;
        props.formEndereco.uf = data.uf;
        props.formEndereco.municipio = data.localidade;
        props.formEndereco.bairro = data.bairro;
        props.formEndereco.endereco = data.logradouro;

    } catch (error) {
        erroCep.value = 'Não foi possível consultar o CEP agora'
    }
}

</script>

<template>
    <Card>
        <CardBody>
            <CardTitle title="Endereço do associado" />

            <span v-if="erroCep" class="text-error">{{ erroCep }}</span>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-2">
                <Input label="CEP"
                    v-model="formEndereco.cep"
                    @blur="buscarCep"
                    :maxlength="10"
                    required />
                <Input label="Estado"
                    v-model="formEndereco.uf"
                    :maxlength="2"
                    required />

                <Input label="Municípios"
                    v-model="formEndereco.municipio"
                    :maxlength="50"
                    required />

                <Input label="Bairro"
                    v-model="formEndereco.bairro"
                    :maxlength="50"
                    required />

                <Input label="Endereço"
                    v-model="formEndereco.endereco"
                    :maxlength="100"
                    required />

            </div>
        </CardBody>
    </Card>
</template>