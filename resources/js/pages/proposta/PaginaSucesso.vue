<script setup>
import Card from '@/components/card/Card.vue';
import CardBody from '@/components/card/CardBody.vue';
import AppLayout from '@/layout/AppLayout.vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

const props = defineProps({
    success: String,
    idProposta: Number
})
</script>
<template>
    <AppLayout class="flex justify-center items-center">
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
    </AppLayout>
</template>