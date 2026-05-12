<script setup>
import Table from '@/components/table/Table.vue';
import StatusProposta from '@/components/StatusProposta.vue';
import { formatDate, formatTime } from '@/components/Utils/dateTime';
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
            icon="file-text">

            <template #thead>
                <tr class="bg-base-content/5">
                    <th class="font-bold text-black">
                        Proposta
                    </th>
                    <th class="font-bold text-black">
                        Associado
                    </th>
                    <th class="font-bold text-black">
                        Corretor
                    </th>
                    <th class="font-bold text-black">
                        Situação
                    </th>
                    <th class="font-bold text-black">
                        Data
                    </th>
                    <th class="font-bold text-black flex justify-center">
                        Opções
                    </th>
                </tr>
            </template>

            <template #tbody>
                <tr class="hover:bg-base-300"
                    v-for="item in propostas.data">
                    <td>
                        <a :href="'/proposta/' + item.id"
                            class="btn btn-link p-0">
                            {{ item.num_proposta }}
                        </a>
                    </td>
                    <td>
                        <a :href="'/proposta/' + item.id"
                            class="btn btn-link p-0">
                            {{ item.associado.nome }}
                        </a>
                    </td>
                    <td>
                        {{ item.cod_corretor }}
                    </td>
                    <td>
                        <StatusProposta :status="item.status_proposta" />
                    </td>
                    <td>
                        {{ formatDate(item.created_at) }}
                        -
                        {{ formatTime(item.created_at) }}
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
                                    <a :href="' /proposta/' + item.id">
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
        <Pagination :paginator="propostas"/>
    </section>
</template>
