<script setup>
import Table from '@/components/table/Table.vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

const props = defineProps({
    matriculas: Array | Object,
})
</script>

<template>
    <Table title="Matrículas"
        icon="file-lines"
        class="mt-3">

        <template #thead>
            <tr>
                <th>Associado</th>
                <th>Matrícula</th>
                <th>Praça</th>
                <th>Orgão</th>
                <th>Cargo</th>
                <th>Cadastrar</th>
            </tr>
        </template>

        <template #tbody>
            <tr class="hover:bg-base-300"
                v-for="matricula in matriculas" :key="matricula.id_associado">
                <td>{{ matricula.nome }}</td>
                <td>{{ matricula.mat }}</td>
                <td>{{ matricula.origem.nome }}</td>
                <td>{{ matricula.orgao.nome }}</td>
                <td>{{ matricula.cargo }}</td>
                <td>
                    <Link :href="route('proposta.index')"
                        class="btn btn-primary btn-sm btn-soft">
                    Criar proposta
                    </Link>
                </td>
            </tr>
        </template>

        <template #append>
            <div class="">
                <Link class="btn btn-primary">
                    <FontAwesomeIcon icon="plus"/>
                Nova matrículas
                </Link>
            </div>
        </template>

    </Table>
</template>