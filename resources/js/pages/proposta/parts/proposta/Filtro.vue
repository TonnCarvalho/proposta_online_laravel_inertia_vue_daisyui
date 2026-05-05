<script setup lang="ts">
import Input from '@/components/form/Input.vue';
import Select from '@/components/form/Select.vue';

import { ref } from 'vue'

const origemItems = ref(['Todos', 'In Progress', 'Done'])
const origemValue = ref('Todos')

</script>

<template>
    <UCard>
        <template #header>
            <div class="flex items-center gap-3">
                <UIcon name="i-lucide-sliders-horizontal" class="text-primary"/>
                <strong>
                    Filtro
                </strong>
            </div>
        </template>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
            <Input label="Pesquisa"
                icon="i-lucide-search"
                placeholder="Nº proposta, CPF ou nome" />

            <UFormField label="Praça"
                size="lg">
                <USelect v-model="origemValue"
                    :items="origemItems"
                    class="w-full"
                    icon="i-lucide-search" />
            </UFormField>
            <!-- DEIXANDO SELECT DINAMICO -->
            <Select label="Situação" :items="origemItems" />
        </div>
    </UCard>
</template>