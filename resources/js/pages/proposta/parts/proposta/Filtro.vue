<script setup>
import Input from '@/components/form/Input.vue';
import Select from '@/components/form/Select.vue';

defineProps({
    origens: Array,
})

</script>

<template>
    <div class="grid grid-cols-1 md:grid-cols-3 items-center gap-3">
        <Input label="Pesquisa"
            placeholder="Nome, CPF ou proposta"
            type="search" />

        <Select label="Praça"
            placeholder="Selecione"
            :items="origens"
            :valueKey="item => item.id"
            :labelKey="item => item.nome" />
    </div>
</template>