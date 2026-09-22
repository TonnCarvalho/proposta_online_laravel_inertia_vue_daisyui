<script setup>
import Table from '@/components/table/Table.vue';
import StatusProposta from '@/components/StatusProposta.vue';
import StatusAssinatura from '@/components/StatusAssinatura.vue';
import primeiroNome from '@/utils/primiroNome'
import { Link, usePage } from '@inertiajs/vue3';
import { EllipsisVertical, FilePen, RefreshCcw, Trash } from '@lucide/vue';
import ModalSituacao from './modalSituacao.vue';
import { ref } from 'vue';

const props = defineProps({
    propostas: Object,
    statusProposta: Array,
})

const page = usePage();

const idUsuarioAcompanhamento = page.props.auth.user.id_usuario;

const modalSituacao = ref(null);
const propostaSelecionada = ref(null);
const statusSelecionado = ref(null);

function abrirModalSituacao(proposta) {
    propostaSelecionada.value = proposta;
    statusSelecionado.value = proposta.status_proposta
    modalSituacao.value.showModal();
}

</script>

<template>
    <Table title="Propostas">
        <template #thead>
            <tr>
                <td>Conferente</td>
                <td>Proposta</td>
                <td>Associado</td>
                <td>CPF</td>
                <td>Situação</td>
                <td>Assinatura</td>
                <td>Praça</td>
                <td>Órgão</td>
                <td>Ação</td>
            </tr>
        </template>

        <template #tbody>
            <tr class="hover:bg-base-300"
                v-for="proposta in propostas.data"
                :key="proposta.id_proposta">

                <td>
                    <Link :href="route('proposta.edit', proposta.id_proposta)">
                        <span class="badge"
                            :class="{
                                'badge-primary badge-soft': idUsuarioAcompanhamento == proposta.acompanhamento_id_usuario,
                                'badge-soft': idUsuarioAcompanhamento != proposta.acompanhamento_id_usuario
                            }">
                            {{ primeiroNome(proposta?.usuarios_nome_acompanhamento) }}
                        </span>
                    </Link>
                </td>

                <td class="text-center p-2">
                    <Link :href="route('proposta.edit', proposta.id_proposta)">
                        {{ proposta?.num_proposta }}
                    </Link>
                </td>

                <td class="text-primary max-w-60 truncate p-2">
                    <Link :href="route('proposta.edit', proposta.id_proposta)">
                        {{ proposta?.associado_nome }}
                    </Link>
                </td>

                <td class="whitespace-nowrap p-2">
                    <Link :href="route('proposta.edit', proposta.id_proposta)">
                        {{ proposta?.cpf }}
                    </Link>
                </td>

                <td class="p-2">
                    <Link :href="route('proposta.edit', proposta.id_proposta)">
                        <StatusProposta :status="proposta?.status_proposta" />
                    </Link>
                </td>

                <td class="p-2">
                    <Link :href="route('proposta.edit', proposta.id_proposta)">
                        <StatusAssinatura :status="proposta?.status_assinatura" />
                    </Link>
                </td>

                <td class="whitespace-nowrap p-2">
                    <Link :href="route('proposta.edit', proposta.id_proposta)">
                        {{ proposta?.origem_nome }}
                    </Link>
                </td>

                <td class="truncate max-w-40 p-2">
                    <Link :href="route('proposta.edit', proposta.id_proposta)">
                        {{ proposta?.orgaos_nome }}
                    </Link>
                </td>

                <td class="dropdown dropdown-end"
                    @click.stop>
                    <div tabindex="0"
                        role="button"
                        class="btn btn-sm btn-ghost">
                        <EllipsisVertical />
                    </div>
                    <ul tabindex="-1"
                        class="dropdown-content menu bg-base-100 rounded-box z-1 w-40 p-2 shadow-sm">
                        <li>
                            <button @click="abrirModalSituacao(proposta)"
                                class="text-primary hover:bg-primary/10">
                                <RefreshCcw size="15" />
                                Situação
                            </button>
                        </li>

                        <li>
                            <a class="text-orange-500 hover:bg-orange-100">
                                <FilePen size="15" />
                                Assinatura
                            </a>
                        </li>
                        <li>
                            <a class="text-red-500  hover:bg-red-100">
                                <Trash size="15" />
                                Recusar
                            </a>
                        </li>
                    </ul>
                </td>
            </tr>
        </template>
    </Table>

    <ModalSituacao ref="modalSituacao"
        :statusProposta="statusProposta"
        :propostaId="propostaSelecionada?.id_proposta"
        v-model="statusSelecionado" />
</template>