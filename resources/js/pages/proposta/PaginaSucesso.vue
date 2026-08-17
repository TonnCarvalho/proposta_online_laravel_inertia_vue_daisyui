<script setup>
import Alert from '@/components/Alert.vue';
import Card from '@/components/card/Card.vue';
import CardBody from '@/components/card/CardBody.vue';
import CardTitle from '@/components/card/CardTitle.vue';
import AppLayout from '@/layout/AppLayout.vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

const props = defineProps({
    success: String,
    idProposta: Number
})
</script>
<template>
    <AppLayout class="flex justify-center items-center">

        <Alert icon="circle-check"
            message="Proposta criada com sucesso!"
            sub-message="A proposta foi cadastrada e está disponível para análise."
            class="alert-success" />

        <Card>
            <CardBody>
                <div class="flex items-center justify-between">
                    <div class="card-title text-base-content flex">
                        <span>
                            Proposta nº <span class="text-primary">{{ idProposta }}</span>
                        </span>
                    </div>
                    <div>Status:
                        <span class="badge"
                            style="background-color:#DBEAFE; border: #DBEAFE; color: #1E40AF ;">
                            <FontAwesomeIcon icon="spinner" />
                            Em andamento
                        </span>
                    </div>
                </div>
                <div>
                    <FontAwesomeIcon :icon="['far', 'calendar']" />
                    Data de criação <span class="font-semibold"> 17/08/2026 </span>
                </div>
            </CardBody>
        </Card>

        <div class="grid grid-cols-2 gap-3 mt-3">
            <Card>
                <CardBody>

                    <CardTitle icon="user"
                        title="Dados do Associado" />

                    <div class="grid grid-cols-2 gap-1">
                        <div>Nome: </div> 
                        <span class="font-semibold">Cleiton Conceição de</span>

                        <div>CPF: </div> 
                        <span class="font-semibold">060</span>

                        <div>Matrícula: </div> 
                        <span class="font-semibold"> 123456</span>

                        <div>Telefone: </div> 
                        <span class="font-semibold">71982810545</span>

                        <div>Email: </div> 
                        <span class="font-semibold">cleiton_601@hotmail.com</span>

                    </div>
                </CardBody>
            </Card>

            <Card>
                <CardBody>
                    
                    <CardTitle icon="file-lines"
                        title="Dados da Proposta" />


                    <div class="grid grid-cols-2  gap-1">
                        <div>Praça: </div>
                        <span class="font-semibold">Governo da Bahia</span>

                        <div>Valor financiado: </div>
                        <span class="font-semibold text-green-600"> R$ 2.000,00</span>

                        <div>Valor da parcela: </div>
                        <span class="font-semibold">R$ 79,00</span>

                        <div>Prazo: </div>
                        <span class="font-semibold">60 meses</span>

                        <div>Email: </div>
                        <span class="font-semibold">cleiton_601@hotmail.com</span>
                    </div>
                </CardBody>
            </Card>
        </div>
        <!-- 
        <Card class="min-h-screen flex">
            <CardBody>
                <div class="flex flex-col justify-center items-center">

                    <FontAwesomeIcon :icon="['fas', 'circle-check']"
                        class="text-success text-5xl" />

                    <h1 class="text-3xl font-bold text-success mt-3">
                        {{ success }}
                    </h1>

                    <div v-if="idProposta"
                        class="flex flex-col">
                        <Link :href="route('proposta.edit', idProposta)"
                            class="btn btn-primary mt-6">
                        Ver proposta
                        </Link>

                        <Link :href="route('proposta.index')"
                            class="btn btn-link mt-2">
                        Ver todas as propostas
                        </Link>
                    </div>
                </div>
            </CardBody>
        </Card>
         -->
    </AppLayout>
</template>