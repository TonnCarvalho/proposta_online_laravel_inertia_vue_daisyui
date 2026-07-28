<script setup>
import Card from '@/components/card/Card.vue';
import CardBody from '@/components/card/CardBody.vue';
import AppLayout from '@/layout/AppLayout.vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

</script>
<template>
    <AppLayout class="flex justify-center items-center">
        <div class="">
            <Card>
                <CardBody>
                    <div class="flex flex-col justify-center items-center">

                        <FontAwesomeIcon :icon="['fas', 'circle-check']"
                            class="text-success text-5xl" />

                        <h1 class="text-3xl font-bold text-success">
                            Proposta criada com sucesso
                        </h1>

                        <div class="flex flex-col">
                            <button class="btn btn-primary mt-6">
                                Ver proposta
                            </button>

                            <Link :href="route('proposta.index')"
                                class="btn btn-link mt-3">
                            Ver todas propostas
                            </Link>
                        </div>
                    </div>
                </CardBody>
            </Card>
        </div>
    </AppLayout>
</template>