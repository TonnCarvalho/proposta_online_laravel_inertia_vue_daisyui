<script setup>
import Table from '@/components/table/Table.vue';
import StatusProposta from '@/components/StatusProposta.vue';
const props = defineProps({
    propostas: Object,
})

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

                <td v-text="proposta?.ultimo_acompanhamento?.id_conferente"></td>

                <td v-text="proposta?.num_proposta"></td>

                <td class="text-primary">
                    <Link :href="route('proposta.edit', proposta?.id_proposta)"
                        v-text="proposta?.associado?.nome" />
                </td>

                <td v-text="proposta?.associado?.cpf"></td>

                <td>
                    <StatusProposta :status="proposta?.status_proposta" />
                </td>

                <td v-text="proposta?.status_assinatura"></td>

                <td v-text="proposta?.associado?.origem?.nome"></td>

                <td v-text="proposta?.associado?.orgao?.nome"></td>

                <td>Ação</td>
            </tr>
        </template>
    </Table>
</template>