<script setup lang="ts">
import TableBody from '@/components/table/TableBody.vue';

const tableTHeadProposta = ['Proposta', 'Associado', 'Situação', 'Opções']
</script>

<template>

    <TableBody :tHead="tableTHeadProposta"
        title="Suas propostas"
        icon="file-text" />

</template>
