<script setup>
import Card from '@/components/card/Card.vue';
import CardBody from '@/components/card/CardBody.vue';
import CardTitle from '@/components/card/CardTitle.vue';
import Input from '@/components/form/Input.vue';
import Table from '@/components/table/Table.vue';
import AppLayout from '@/layout/AppLayout.vue';
import PageHeader from '@/layout/parts/AppLayout/PageHeader.vue';

</script>
<template>
    <AppLayout>
        <PageHeader title="Pesquisa associado"
            icon="user"
            sub-title="Mostra todas as matrículas" />
        <!-- Pesquisa -->
        <Card>
            <CardBody>
                <CardTitle title="Pesquisa" />

                <div class="w-full lg:w-1/2 mx-auto">

                    <Input label="CPF"
                        placeholder="000.000.000-00"
                        required />

                    <div class="grid grid-cols-2 gap-3 justify-items-center mt-2">
                        <button class="btn btn-primary btn-block">
                            Pesquisar
                        </button>

                        <Link class="btn btn-soft btn-block"
                            :href="route('proposta.index')">
                        Voltar
                        </Link>

                    </div>
                </div>
            </CardBody>
        </Card>
        <!-- Matriculas -->

        <Table title="Matrículas"
            icon="file"
            class="mt-3">
            <template #append>
                <p class="font-medium my-2">
                    Nome: <span class="font-normal">Cleiton Conceição de Carvalho</span>
                </p>
            </template>
            <template #thead>
                <tr>
                    <th>Matrícula</th>
                    <th>Praça</th>
                    <th>Orgão</th>
                    <th>Cargo</th>
                    <th></th>
                </tr>
            </template>

            <template #tbody>
                <tr class="hover:bg-base-300">
                    <td>123456</td>
                    <td>Estado da Bahia</td>
                    <td>Nome do orgão</td>
                    <td>Nome do cargo</td>
                    <td>
                        <button class="btn btn-primary btn-sm btn-soft">
                            Cadastrar
                        </button>
                    </td>
                </tr>

                <tr class="hover:bg-base-300">
                    <td>123456</td>
                    <td>Estado da Bahia</td>
                    <td>Nome do orgão</td>
                    <td>Nome do cargo</td>
                    <td>Usar</td>
                </tr>
            </template>
        </Table>
    </AppLayout>
</template>