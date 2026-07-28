<script setup>
import AppLayout from '@/layout/AppLayout.vue';
import PageHeader from '@/layout/parts/AppLayout/PageHeader.vue';
import { maskMoney } from '@/utils/masks.js';
import { formatDate } from '@/utils/dateTime.js';
import { useForm } from '@inertiajs/vue3';
import Card from '@/components/card/Card.vue';
import CardBody from '@/components/card/CardBody.vue';
import AssociadoForm from './parts/form/AssociadoForm.vue';
import FinanceiroForm from './parts/form/FinanceiroForm.vue';
import EnderecoForm from './parts/form/EnderecoForm.vue';
import BancoContraChequeForm from './parts/form/BancoContraChequeForm.vue';
import BancoRecimentoForm from './parts/form/BancoRecimentoForm.vue';

const props = defineProps({
    proposta: Object,
    origens: Array | Object,
    sexoAssociado: Array,
    estadoCivilAssociado: Array,
    ocupacaoAssociado: Array,
    tipoProposta: Array,
    tipoContaAssociado: Array,
    fontePagamento: Array,
})

const proposta = props.proposta[0]

const form = useForm({
    associado: {
        nome: proposta.associado?.nome ?? '',
        cod_local: proposta?.cod_local ?? '',
        cpf: proposta.associado?.cpf ?? '',
        rg: proposta.associado?.rg ?? '',
        orgao_exp: proposta.associado?.orgao_exp ?? '',
        email: proposta.associado?.email ?? '',
        data_nasc: formatDate(proposta.associado?.data_nasc ?? ''),
        nat: proposta.associado?.nat ?? '',
        sexo: proposta.associado?.sexo ?? '',
        cel: proposta.associado?.cel ?? '',
        nome_pai: proposta.associado?.nome_pai ?? '',
        nome_mae: proposta.associado?.nome_mae ?? '',
        estado_civil: proposta.associado?.estado_civil ?? '',
        mat: proposta.associado?.mat ?? '',
        cod_orgao: proposta.associado?.cod_orgao ?? '',
        setor: proposta.associado?.setor ?? '',
        cargo: proposta.associado?.cargo ?? '',
        ocupacao: proposta.associado?.ocupacao ?? '',
        data_admissao: formatDate(String(proposta.associado?.data_admissao ?? '')),
    },
    financeiro: {
        cod_corretor: proposta?.cod_corretor ?? '',
        data_proposta: formatDate(proposta?.data_proposta ?? ''),
        num_proposta: proposta?.num_proposta ?? '',
        valor_financiado: maskMoney(String(proposta?.valor_financiado ?? '')),
        valor_liberado: maskMoney(String(proposta?.valor_liberado ?? '')),
        valor_parcela: maskMoney(String(proposta?.valor_parcela ?? '')),
        valor_mensalidade: maskMoney(String(proposta?.valor_mensalidade ?? '')),
        prazo: proposta?.prazo ?? '',
        tipo_proposta: proposta?.tipo_proposta ?? '',
        iof: maskMoney(String(proposta?.iof ?? '')),
        taxa: proposta?.taxa ?? '',
        fonte_pagamento: proposta?.id_fonte_pagamento ?? '',
    },
    endereco: {
        cep: proposta.associado?.cep ?? '',
        uf: proposta.associado?.uf ?? '',
        municipio: proposta.associado?.municipio ?? '',
        bairro: proposta.associado?.bairro ?? '',
        endereco: proposta.associado?.endereco ?? '',
    },
    bancoContraCheque: {
        banco: proposta.associado?.banco ?? '',
        agencia: proposta.associado?.agencia ?? '',
        conta: proposta.associado?.conta ?? ''
    },
    bancoRecebimento: {
        chave_pix: proposta.associado?.chave_pix ?? '',
        banco_pagamento: proposta.associado?.banco_pagamento ?? '',
        agencia_pagamento: proposta.associado?.agencia_pagamento ?? '',
        conta_pagamento: proposta.associado?.conta_pagamento ?? '',
        tipo_bancario: proposta.associado?.tipo_bancario ?? ''
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
        <PageHeader :title="`${form.financeiro.num_proposta} - ${form.associado.nome}`"
            icon="file-lines" />
        <form @submit.prevent="submit">

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
                            {{ form.processing ?
                                'Editando proposta' :
                                'Editar proposta' }}
                        </button>

                        <Link :href="route('proposta.index')"
                            class="btn btn-soft">
                        Voltar
                        </Link>

                    </div>
                </CardBody>
            </Card>
        </form>
    </AppLayout>
</template>