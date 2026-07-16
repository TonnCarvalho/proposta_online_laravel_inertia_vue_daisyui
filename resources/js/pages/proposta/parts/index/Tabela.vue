<script setup>
import Table from '@/components/table/Table.vue';
import StatusProposta from '@/components/StatusProposta.vue';
import { formatDate, formatTime } from '@/utils/dateTime';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import Pagination from '@/components/Pagination.vue';

defineProps({
    propostas: Object
})
const tableOptionProposta = [
    { label: 'Ver', icon: ['fas', 'eye'], colorIcon: 'text-primary' },
    { label: 'Excluir', icon: ['fas', 'trash'], colorIcon: 'text-error' },
]

</script>

<template>
    <section class="mt-5">

        <Table title="Suas propostas"
            icon="file">
            <template #thead>
                <tr>
                    <th>
                        Proposta
                    </th>
                    <th>
                        Associado
                    </th>
                    <th>
                        Praça
                    </th>
                    <th>
                        Situação
                    </th>
                    <th>
                        Data
                    </th>
                    <th class="flex justify-center">
                        Opções
                    </th>
                </tr>
            </template>

            <template #tbody>
                <tr class="hover:bg-base-300"
                    v-for="item in propostas.data">
                    <td>
                        <Link :href="route('proposta.edit', item.id_proposta)"
                            class="btn btn-link p-0">
                            {{ item.num_proposta }}
                        </Link>
                    </td>
                    <td>
                        <Link :href="route('proposta.edit', item.id_proposta)"
                            class="text-primary font-semibold btn-link p-0">
                            {{ item.associado.nome }}
                        </Link>
                    </td>
                    <td>
                        {{ item.origem.nome }}
                    </td>
                    <td>
                        <StatusProposta :status="item.status_proposta" />
                    </td>
                    <td>
                        {{ formatDate(item.data_proposta) }}
                        -
                        {{ formatTime(item.data_proposta) }}
                    </td>

                    <td class="flex justify-center">
                        <div class="dropdown dropdown-left dropdown-hover">
                            <div tabindex="0"
                                role="button"
                                class="btn btn-sm m-1">
                                <FontAwesomeIcon :icon="['fas', 'ellipsis-vertical']" />
                            </div>
                            <ul tabindex="-1"
                                class="dropdown-content menu bg-base-100 rounded-box z-1 w-52 p-2 shadow-sm">
                                <li v-for="dropdown in tableOptionProposta">
                                    <a :href="route('proposta.edit', item.id_proposta)">
                                        <FontAwesomeIcon :icon="dropdown.icon"
                                            :class="dropdown.colorIcon" />
                                        {{ dropdown.label }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            </template>
        </Table>

        <Pagination :paginator="propostas" />
    </section>
</template>
