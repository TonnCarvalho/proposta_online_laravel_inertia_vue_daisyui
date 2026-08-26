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
import Alert from '@/components/Alert.vue';
import { maskPhone } from '@/utils/masks.js';
import { formatDate } from '@/utils/dateTime.js';
import Input from '@/components/form/Input.vue';
import { FilePlus } from '@lucide/vue';
import DocumentosForm from './parts/form/DocumentosForm.vue';

const props = defineProps({
    idAssociado: Number,
    data: Object,
    cpf: String,
    tipoCadastro: String,
    origens: Array | Object,
    tipoProposta: Array,
    sexoAssociado: Array,
    estadoCivilAssociado: Array,
    ocupacaoAssociado: Array,
    tipoContaAssociado: Array,
    fontePagamento: Array,
})

//Data de hoje para criar a proposta.
const hoje = new Date();
const dia = String(hoje.getDate()).padStart(2, '0');
const mes = String(hoje.getMonth() + 1).padStart(2, '0')
const ano = hoje.getFullYear();
const dataAtual = `${dia}/${mes}/${ano}`

const form = useForm({

    tipoCadastro: props.tipoCadastro,
    idAssociado: props.idAssociado,

    documento: {
        frenteDocumento: '',
        versoDocumento: '',
        contraCheque: '',
        comprovanteBancario: '',
        comprovanteResidencia: '',
        consultaReceitaFederal: '',
        averbacaoBeneficio: '',
        averbacaoMensalidade: '',
        outrosDocumentos: '',
    },
    associado: {
        nome: props.data?.nome ?? '',
        cod_local: props.data?.cod_local ?? '',
        cpf: props.data?.cpf ?? props.cpf ?? '',
        rg: props.data?.rg ?? '',
        orgao_exp: props.data?.orgao_exp ?? '',
        email: props.data?.email ?? '',
        data_nasc: formatDate(props.data?.data_nasc) ?? '',
        nat: props.data?.nat ?? '',
        sexo: props.data?.sexo ?? '',
        cel:maskPhone(props.data?.cel) ?? '',
        nome_pai: props.data?.nome_pai ?? '',
        nome_mae: props.data?.nome_mae ?? '',
        estado_civil: props.data?.estado_civil ?? '',
        mat: props.data?.mat ?? '',
        cod_orgao: props.data?.cod_orgao ?? '',
        setor: props.data?.setor ?? '',
        cargo: props.data?.cargo ?? '',
        ocupacao: props.data?.ocupacao ?? '',
        data_admissao: formatDate(props.data?.data_admissao) ?? '',
    },
    financeiro: {
        cod_corretor: props.data?.cod_corretor ?? '',
        data_proposta: dataAtual ?? '',
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
        cep: props.data?.cep ?? '',
        uf: props.data?.uf ?? '',
        municipio: props.data?.municipio ?? '',
        bairro: props.data?.bairro ?? '',
        endereco: props.data?.endereco ?? '',
    },
    bancoContraCheque: {
        banco: props.data?.banco ?? '',
        agencia: props.data?.agencia ?? '',
        conta: props.data?.conta ?? ''
    },
    bancoRecebimento: {
        chave_pix: props.data?.chave_pix ?? '',
        banco_pagamento: props.data?.banco_pagamento ?? '',
        agencia_pagamento: props.data?.agencia_pagamento ?? '',
        conta_pagamento: props.data?.conta_pagamento ?? '',
        tipo_bancario: props.data?.tipo_bancario ?? '',
    },
})

const submit = () => {
    form.post(route('proposta.store'), {
        preserveScroll: true,
        onSuccess: () => {
        },
        onError: (error) => {
        },
        onFinish: () => {
        }
    })
}

</script>
<template>
    <AppLayout>
        <PageHeader title="Nova proposta"
            icon="file-circle-plus" />

        <Alert v-if="tipoCadastro === 'novo_associado'"
            message="Associado não encontrado"
            subMessage="Vamos fazer um novo cadastro"
            icon="UserRoundPlus"
            soft
            class="bg-yellow-100 border-yellow-400 text-yellow-600" />

        <form @submit.prevent="submit">

            <Input name="tipo_cadastro"
                v-model="form.tipoCadastro"
                type="hidden"
                class="hidden" />

            <Input name="idAssociado"
                v-model="form.idAssociado"
                type="hidden"
                class="hidden" />

            <div class="grid grid-cols-1">
                <DocumentosForm :formDocumento="form.documento"/>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 mt-3">
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
                            <FilePlus v-if="!form.processing"
                                size="18" />
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