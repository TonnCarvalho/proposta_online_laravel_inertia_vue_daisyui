<script setup>

import { ref } from 'vue'

const origemValue = ref('Todos')

const model = defineModel();
defineProps({
    label: String,
    required: Boolean,
    error: String,
    help: String,

    type: {
        type: String,
        default: 'text'
    },
    name: String,
    placeholder: String,
    size: {
        type: String,
        default: 'lg'
    },
    variant: {
        type: String,
        default: 'outline',
    },
    icon: String,
    trailingIcon: String,
    items: String|Array,
})
</script>

<template>
    <UFormField :label="label"
        :help="help"
        :size="size"
        :required="required"
        :error="error">
        <USelect
            :name="name"
            :id="name"
            :placeholder="placeholder"
            class="w-full"
            :class="$attrs.class"
            :icon="icon"
            :trailing-icon="trailingIcon"
            :variant="variant"
            v-model="model"
            :items="items" />
    </UFormField>
</template>