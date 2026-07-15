<script setup>
import AppLayout from '@/layout/AppLayout.vue';
import PageHeader from '@/layout/parts/AppLayout/PageHeader.vue';
import { useForm } from '@inertiajs/vue3';
import Card from '@/components/card/Card.vue';
import CardBody from '@/components/card/CardBody.vue';
import AssociadoForm from './parts/form/AssociadoForm.vue';
import FinanceiroForm from './parts/form/FinanceiroForm.vue';
import EnderecoForm from './parts/form/EnderecoForm.vue';
import BancoContraChequeForm from './parts/form/BancoContraChequeForm.vue';
import BancoRecimentoForm from './parts/form/BancoRecimentoForm.vue';

defineProps({
    origens: Array | Object,
    tipoProposta: Array,
    fontePagamento: Array,
})

const form = useForm({
    associado: {
        nome: '',
        cod_local: '',
        cpf: '',
        rg: '',
        org_exp: '',
        email: '',
        data_nasc: '',
        nat: '',
        sexo: '',
        cel: '',
        nome_pai: '',
        nome_mae: '',
        estado_civil: '',
        mat: '',
        cod_orgao: '',
        setor: '',
        cargo: '',
        ocupacao: '',
        data_admissao: '',
    },
    financeiro: {
        cod_corretor: '',
        data_proposta: '',
        valor_financiado: '',
        valor_liberado: '',
        valor_parcela: '',
        valor_mensalidade: '',
        prazo: '',
        tipo_proposta: '',
        iof: '',
        taxa: '',
        fonte_pagamento: '',
    },
    endereco: {
        cep: '',
        uf: '',
        municipio: '',
        bairro: '',
        endereco: '',
    },
    bancoContraCheque: {
        banco: '',
        agencia: '',
        conta: ''
    },
    bancoRecebimento: {
        chave_pix: '',
        banco_pagamento: '',
        agencia_pagamento: '',
        conta_pagamento: '',
        tipo_bancario: '',
    },
})

const submit = () => {
    form.post(route('proposta.post'), {
        preserveScroll: true,

        onSuccess: () => {
            console.log('sucesso');
        },
        onError: (error) => {
            console.log(error)
        },
        onFinish: () => {
            console.log('finalizado');
        }
    })
}
</script>
<template>
    <AppLayout>
        <PageHeader title="Nova proposta"
            icon="file-circle-plus" />
        <form @submit.prevent="submit">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                <AssociadoForm :formAssociado="form.associado"
                    :origens="origens"
                    :errors="form.errors" />

                <FinanceiroForm :formFinanceiro="form.financeiro"
                    :tipoProposta="tipoProposta"
                    :fontePagamento="fontePagamento"
                    :errors="form.errors" />

                <EnderecoForm :formEndereco="form.endereco"
                    :errors="form.errors" />

                <BancoContraChequeForm :formBancoContraque="form.bancoContraCheque"
                    :errors="form.errors" />

                <BancoRecimentoForm :formBancoRecebimento="form.bancoRecebimento"
                    :errors="form.errors" />
            </div>

            <Card class="mt-3 sticky bottom-0">
                <CardBody>
                    <div class="flex gap-3">

                        <button :disabled="form.processing"
                            type="submit"
                            class="btn btn-primary btn-wide">
                            <span v-if="form.processing"
                                class="loading loading-spinner loading.sm">
                            </span>
                            {{ form.processing ? 'Criando proposta' : 'Criar proposta' }}
                        </button>

                        <Link :href="route('pesquisaCpfCadastro.index')"
                            class="btn btn-soft">
                        Voltar
                        </Link>

                    </div>
                </CardBody>
            </Card>
        </form>
    </AppLayout>
</template>