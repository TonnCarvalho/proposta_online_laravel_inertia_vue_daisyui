<script setup>
import Table from '@/components/table/Table.vue';
import { UserPlus } from '@lucide/vue';

const props = defineProps({
    matriculas: Array | Object,
})
</script>

<template>
    <Table title="Matrículas"
        icon="Users"
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
                v-for="matricula in matriculas"
                :key="matricula.id_associado">
                <td>{{ matricula.nome }}</td>
                <td>{{ matricula.mat }}</td>
                <td>{{ matricula.origem.nome }}</td>
                <td>{{ matricula.orgao.nome }}</td>
                <td>{{ matricula.cargo }}</td>
                <td>
                    <Link :href="route('proposta.create', {
                        tipoCadastro: 'matricula_existente',
                        associado: matricula.id_associado
                    })"
                        class="btn btn-primary btn-sm btn-soft">
                    Criar proposta
                    </Link>
                </td>
            </tr>
        </template>

        <template #append>
            <div>

                <Link :href="route('proposta.create', {
                    tipoCadastro: 'nova_matricula',
                    associado: props.matriculas[0]['id_associado']
                })"
                    class="btn btn-primary">
                <UserPlus size="20" />
                Nova matrículas
                </Link>
            </div>
        </template>

    </Table>
</template>