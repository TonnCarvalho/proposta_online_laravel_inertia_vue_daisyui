<template>
    <Table title="Propostas">
        <template #thead>
            <tr>
                <th v-for="itemThead in thead">
                    {{ itemThead }}
                </th>
            </tr>
        </template>

        <template #tbody>
            <tr v-for="proposta in propostas.data"
                :key="proposta.id_proposta"
                class="hover:bg-base-300">
                <td>
                    <Link :href="route('proposta.edit', proposta.id_proposta)">
                    {{ proposta.num_proposta }}
                    </Link>
                </td>

                <td class="text-primary">
                    <Link :href="route('proposta.edit', proposta.id_proposta)">
                    {{ proposta.associado.nome }}
                    </Link>
                </td>

                <td>
                    <button @click="modalConfirmaEnvio.showModal(proposta)"
                        class="btn btn-sm btn-primary btn-soft btn-circle">
                        <ArrowUpCircle />
                    </button>
                </td>

                <td>
                    <Link :href="route('proposta.edit', proposta.id_proposta)">
                    {{ proposta.origem.nome }}
                    </Link>
                </td>

                <td>
                    <Link :href="route('proposta.edit', proposta.id_proposta)">
                    {{ maskMoney(proposta.valor_financiado) }}
                    </Link>
                </td>

                <td>
                    <Link :href="route('proposta.edit', proposta.id_proposta)">
                    {{ maskMoney(proposta.valor_parcela) }}
                    </Link>
                </td>

                <td>
                    <Link :href="route('proposta.edit', proposta.id_proposta)">
                    {{ maskMoney(proposta.valor_mensalidade) }}
                    </Link>
                </td>

                <td>
                    <Link :href="route('proposta.edit', proposta.id_proposta)">
                    {{ proposta.prazo }}
                    </Link>
                </td>

            </tr>
        </template>
    </Table>

    <ModalConfirmaEnvio ref="modalConfirmaEnvio" />
</template>

<script setup>
import Table from '@/components/table/Table.vue';
import ModalConfirmaEnvio from './ModalConfirmaEnvio.vue';
import { maskMoney } from '@/utils/masks';
import { ArrowUpCircle } from '@lucide/vue';
import { ref } from 'vue';

const props = defineProps({
    propostas: Array,
})
const thead = ['Proposta', 'Associado', 'Enviar', 'Praça', 'Financiado', 'Parcela', 'Mensalidade', 'Prazo']

const modalConfirmaEnvio = ref(null)
</script>