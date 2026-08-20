<script setup>
import Card from '@/components/card/Card.vue';
import CardBody from '@/components/card/CardBody.vue';
import CardTitle from '@/components/card/CardTitle.vue';
import Input from '@/components/form/Input.vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { maskCpf } from '@/utils/masks';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import { Search } from '@lucide/vue';

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
    if (cpf.value.length < 14) {
        error.value = 'CPF incompleto';
        return;
    }

    try {
        loading.value = true;
        
        const response = await fetch(`
        /proposta/pesquisar?cpf=${encodeURIComponent(cpf.value)}
        `)
        
        if (!response.ok) {
            throw new Error('response error.')
        }
        
        const data = await response.json();

        if(data.redirect) {
            router.visit(data.redirect)
            return;
        }

        emit('resultado', data.data);

    } catch (error) {
        error.value = error.message;
    } finally {
        loading.value = false;
    }

}

</script>

<template>
    <Card>
        <CardBody>
            <CardTitle title="Pesquisa"
                icon="Search" />

            <div class="w-full lg:w-1/2 mx-auto">

                <Input label="CPF"
                    v-model="cpf"
                    @keyup.enter="pesquisaCpf"
                    :mask="maskCpf"
                    :maxlength="14"
                    placeholder="000.000.000-00"
                    required />
                <span class="text-error">
                    {{ error }}
                </span>

                <div class="grid grid-cols-2 gap-3 justify-items-center mt-2">
                    <button @click="pesquisaCpf"
                        type="button"
                        :disabled="loading"
                        class="btn btn-primary btn-block">
                        <Search size="16"
                            v-if="!loading" />
                        <span v-if="loading"
                            class="loading loading-spinner">
                        </span>
                        {{ loading ? 'Pesquisando' : 'Pesquisar' }}
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