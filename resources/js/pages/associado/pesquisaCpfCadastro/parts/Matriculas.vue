<script setup>
import Table from '@/components/table/Table.vue';

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
                v-for="item in matriculas">
                <td>{{ item.nome }}</td>
                <td>{{ item.mat }}</td>
                <td>{{ item.origem.nome }}</td>
                <td>{{ item.orgao.nome }}</td>
                <td>{{ item.cargo }}</td>
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
                Nova matrículas
                </Link>
            </div>
        </template>

    </Table>
</template>