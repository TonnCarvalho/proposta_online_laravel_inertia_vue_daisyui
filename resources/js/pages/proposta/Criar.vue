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

const props = defineProps({
    data: Object,
    tipoCadastro: String,
    origens: Array | Object,
    tipoProposta: Array,
    sexoAssociado: Array,
    estadoCivilAssociado: Array,
    ocupacaoAssociado: Array,
    tipoContaAssociado: Array,
    fontePagamento: Array,
})

const form = useForm({
    associado: {
        nome: props.data.nome ?? '',
        cod_local: props.data.cod_local ?? '',
        cpf: props.data.cpf ?? '',
        rg: props.data.rg ?? '',
        orgao_exp: props.data.orgao_exp ?? '',
        email: props.data.email ?? '',
        data_nasc: props.data.data_nasc ?? '',
        nat: props.data.nat ?? '',
        sexo: props.data.sexo ?? '',
        cel: props.data.cel ?? '',
        nome_pai: props.data.nome_pai ?? '',
        nome_mae: props.data.nome_mae ?? '',
        estado_civil: props.data.estado_civil ?? '',
        mat: props.data.mat ?? '',
        cod_orgao: props.data.cod_orgao ?? '',
        setor: props.data.setor ?? '',
        cargo: props.data.cargo ?? '',
        ocupacao: props.data.ocupacao ?? '',
        data_admissao: props.data.data_admissao ?? '',
    },
    financeiro: {
        cod_corretor: props.data.cod_corretor ?? '',
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
        cep: props.data.cep ?? '',
        uf: props.data.uf ?? '',
        municipio: props.data.municipio ?? '',
        bairro: props.data.bairro ?? '',
        endereco: props.data.endereco ?? '',
    },
    bancoContraCheque: {
        banco: props.data.banco ?? '',
        agencia: props.data.agencia ?? '',
        conta: props.data.conta ?? ''
    },
    bancoRecebimento: {
        chave_pix: props.data.chave_pix ?? '',
        banco_pagamento: props.data.banco_pagamento ?? '',
        agencia_pagamento: props.data.agencia_pagamento ?? '',
        conta_pagamento: props.data.conta_pagamento ?? '',
        tipo_bancario: props.data.tipo_bancario ?? '',
    },
})

const submit = () => {
    form.post(route('proposta.store'), {
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
            
            <input :value="tipoCadastro" />
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                <AssociadoForm :formAssociado="form.associado"
                    :origens="origens"
                    :sexoAssociado="sexoAssociado"
                    :estadoCivilAssociado="estadoCivilAssociado"
                    :ocupacaoAssociado="ocupacaoAssociado"
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
                    :tipoContaAssociado="tipoContaAssociado"
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