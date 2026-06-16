<script setup>
import Card from '@/components/card/Card.vue';
import CardBody from '@/components/card/CardBody.vue';
import CardTitle from '@/components/card/CardTitle.vue';
import Input from '@/components/form/Input.vue';
import { ref } from 'vue';

const emit = defineEmits(['resultado']);
const cpf = ref('');
const loading = ref(false);
const error = ref('');

const pesquisaCpf = async () => {
    error.value = '';
    if (!cpf.value) {
        error.value = 'Informe o CPF.'
        return;
    }

    try {
        loading.value = true;

        const response = await fetch(`/api/associado/pesquisar?cpf=${encodeURIComponent(cpf.value)}`)
        const data = await response.json();

        if (!response.ok) {
            throw new Error(data.message)
        }

        emit('resultado', data.data);

    } catch (error) {
        error.value = error.message;
    } finally {
        loading.value = false;
    }

}

const maskCpf = (event) => {
    let value = event.target.value

    //Remove tudo que não for número
    value = value.replace(/\D/g, '')

    //Limite para 11 dígitos
    value = value.slice(0, 11)

    //Aplica a máscara: 000.000.000-00
    value = value.replace(/(\d{3})(\d)/, '$1.$2');
    value = value.replace(/(\d{3})(\d)/, '$1.$2');
    value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');

    cpf.value = value;
}

</script>

<template>
    <Card>
        <CardBody>
            <CardTitle title="Pesquisa"
                icon="search" />

            <div class="w-full lg:w-1/2 mx-auto">

                <Input label="CPF"
                    v-model="cpf"
                    @input="maskCpf"
                    placeholder="000.000.000-00"
                    required />

                <div class="grid grid-cols-2 gap-3 justify-items-center mt-2">
                    <button @click="pesquisaCpf"
                        :disabled="loading"
                        class="btn btn-primary btn-block">
                        {{ loading ? 'Pesquisando...' : 'Pesquisar' }}
                    </button>

                    <Link class="btn btn-soft btn-block"
                        :href="route('proposta.index')">
                    Voltar
                    </Link>

                </div>
            </div>
        </CardBody>
    </Card>
</template>