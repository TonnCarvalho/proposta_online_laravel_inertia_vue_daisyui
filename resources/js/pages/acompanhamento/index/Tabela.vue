<script setup>
import Table from '@/components/table/Table.vue';
import StatusProposta from '@/components/StatusProposta.vue';
import StatusAssinatura from '@/components/StatusAssinatura.vue';
import primeiroNome from '@/utils/primiroNome'
import { router, usePage } from '@inertiajs/vue3';
import { EllipsisVertical } from '@lucide/vue';

const props = defineProps({
    propostas: Object,
})
const page = usePage();

const idUsuarioAcompanhamento = page.props.auth.user.id_usuario;

const editarProposta = (idProposta) => {
    router.visit(route('proposta.edit', idProposta))
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
            <tr class="hover:bg-base-300 cursor-pointer"
                v-for="proposta in propostas.data"
                :key="proposta.id_proposta"
                @click="editarProposta(proposta.id_proposta)">

                <td>
                    <span class="badge"
                        :class="{
                            'badge-primary badge-soft': idUsuarioAcompanhamento == proposta.acompanhamento_id_usuario,
                            'badge-soft': idUsuarioAcompanhamento != proposta.acompanhamento_id_usuario
                        }">
                        {{ primeiroNome(proposta?.usuarios_nome_acompanhamento) }}
                    </span>
                </td>

                <td class="text-center p-2"
                    v-text="proposta?.num_proposta">
                </td>

                <td class="text-primary max-w-60 truncate p-2"
                    v-text="proposta?.associado_nome">
                </td>

                <td class="whitespace-nowrap p-2"
                    v-text="proposta?.cpf">
                </td>

                <td class="p-2">
                    <StatusProposta :status="proposta?.status_proposta" />
                </td>

                <td class="p-2">
                    <StatusAssinatura :status="proposta?.status_assinatura" />
                </td>

                <td class="whitespace-nowrap p-2"
                    v-text="proposta?.origem_nome">
                </td>

                <td class="truncate max-w-40 p-2"
                    :title="proposta?.orgaos_nome"
                    v-text="proposta?.orgaos_nome">
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
                            <a>Item 1</a>
                        </li>
                    </ul>
                </td>
            </tr>
        </template>
    </Table>
</template>