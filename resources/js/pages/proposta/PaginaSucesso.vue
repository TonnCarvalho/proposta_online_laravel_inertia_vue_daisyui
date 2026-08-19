<script setup>
import Alert from '@/components/Alert.vue';
import Card from '@/components/card/Card.vue';
import CardBody from '@/components/card/CardBody.vue';
import CardTitle from '@/components/card/CardTitle.vue';
import AppLayout from '@/layout/AppLayout.vue';
import { Calendar, LoaderCircle, Eye, ChevronRight, FilePlusCorner } from '@lucide/vue';
import { maskMoney } from '@/utils/masks';

const props = defineProps({
    success: String,
    dadosAssociado: Array,
    dadosProposta: Array,
})

const oQueFazer = [
    {
        icone: Eye,
        corIcone: 'text-blue-700',
        bgIcone: 'bg-blue-200',
        titulo: 'Ver proposta',
        subTitulo: 'Visualizar todos os detalhes da proposta',
        link: route('proposta.edit', props.dadosProposta.id_proposta)
    },
    {
        icone: FilePlusCorner,
        corIcone: 'text-green-700',
        bgIcone: 'bg-green-200',
        titulo: 'Nova proposta',
        subTitulo: 'Crie uma nova proposta',
        link: route('pesquisaCpfCadastro.index')
    }
]

//Data de hoje para criar a proposta.
const hoje = new Date();
const dia = String(hoje.getDate()).padStart(2, '0');
const mes = String(hoje.getMonth() + 1).padStart(2, '0')
const ano = hoje.getFullYear();
const dataAtual = `${dia}/${mes}/${ano}`

</script>
<template>
    <AppLayout class="flex justify-center items-center">

        <Alert icon="circle-check"
            message="Proposta criada com sucesso!"
            sub-message="A proposta foi cadastrada e está disponível para análise."
            class="alert-success" />

        <Card>
            <CardBody>
                <div class="flex flex-wrap items-center justify-between">
                    <div class="card-title text-base-content flex">
                        <span>
                            Proposta nº <span class="text-primary">
                                {{ props.dadosProposta.num_proposta }}
                            </span>
                        </span>
                    </div>
                    <div>Status:
                        <span class="badge"
                            style="background-color:#DBEAFE; border: #DBEAFE; color: #1E40AF ;">
                            <LoaderCircle size="14" />
                            Em andamento
                        </span>
                    </div>
                </div>
                <div class="flex items-center gap-1">
                    <Calendar size="14" />
                    Data de criação <span class="font-semibold"> {{ dataAtual }} </span>
                </div>
            </CardBody>
        </Card>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-3">
            <Card>
                <CardBody>

                    <CardTitle icon="User"
                        title="Dados do Associado" />

                    <div class="grid grid-cols-2 gap-1">
                        <div class="text-base-content">Nome:</div>
                        <span class="font-semibold">
                            {{ props.dadosAssociado.nome }}

                        </span>

                        <div class="text-base-content">CPF:</div>
                        <span class="font-semibold">
                            {{ props.dadosAssociado.cpf }}

                        </span>

                        <div class="text-base-content">Matrícula:</div>
                        <span class="font-semibold">
                            {{ props.dadosAssociado.mat }}

                        </span>

                        <div class="text-base-content">Telefone:</div>
                        <span class="font-semibold">
                            {{ props.dadosAssociado.cel }}

                        </span>

                        <div class="text-base-content">Email:</div>
                        <span class="font-semibold">
                            {{ props.dadosAssociado.email }}

                        </span>

                    </div>
                </CardBody>
            </Card>

            <Card>
                <CardBody>

                    <CardTitle icon="FileText"
                        title="Dados da Proposta" />

                    <div class="grid grid-cols-2  gap-1">
                        <div class="text-base-content">Praça: </div>
                        <span class="font-semibold">
                            {{props.dadosProposta.praca}}
                        </span>

                        <div class="text-base-content">Valor financiado:</div>
                        <span class="font-semibold text-green-600">
                            R$ {{maskMoney(props.dadosProposta.valor_financiado)}}
                        </span>

                        <div class="text-base-content">Valor liberado:</div>
                        <span class="font-semibold text-green-600">
                            R$ {{maskMoney(props.dadosProposta.valor_liberado)}}
                        </span>

                        <div class="text-base-content">Valor da parcela: </div>
                        <span class="font-semibold">
                            R$ {{maskMoney(props.dadosProposta.valor_parcela)}}

                        </span>

                        <div class="text-base-content">Prazo: </div>
                        <span class="font-semibold">
                            {{props.dadosProposta.prazo}} meses
                        </span>

                    </div>
                </CardBody>
            </Card>
        </div>

        <div class="mt-3">
            <Card>
                <CardBody>
                    <CardTitle title="O que deseja fazer?"
                        sub-message="Escolha uma opção abaixo para continuar." />

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <Link v-for="item in oQueFazer"
                            :href="item.link">
                        <Card>
                            <CardBody>
                                <div class="flex items-center gap-3">
                                    <div class="p-3 rounded-lg"
                                        :class="item.bgIcone">
                                        <component :is="item.icone"
                                            size="40"
                                            :class="item.corIcone" />
                                    </div>
                                    <div>
                                        <p class="font-bold">
                                            {{ item.titulo }}
                                        </p>
                                        <p>
                                            {{ item.subTitulo }}
                                        </p>
                                    </div>
                                    <ChevronRight class="ml-auto"/>
                                </div>
                            </CardBody>
                        </Card>
                        </Link>
                    </div>
                </CardBody>
            </Card>
        </div>
    </AppLayout>
</template>