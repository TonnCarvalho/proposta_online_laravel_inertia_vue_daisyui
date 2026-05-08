<script setup>

const model = defineModel();
defineProps({
    label: String,
    error: String,
    help: String,
    name: String,
    placeholder: String,
    placeholderDisabled: {
        type: Boolean,
        default: false,
    },
    items: Array,
    labelKey: Function,
    valueKey: Function,
})
</script>

<template>
    <fieldset class="fieldset">
        <legend :for="name"
            class="block mb-1 text-sm font-medium">
            {{ label }}
        </legend>
        <select class="select w-full"
            :name="name"
            v-model="model">
            <option selected
                value=""
                :disabled="placeholderDisabled">
                {{ placeholder }}
            </option>

            <option v-for="item in items"
                :key="valueKey(item)"
                :value="valueKey(item)">
                {{ labelKey(item) }}
            </option>

        </select>
        <span v-if="help"
            class="label">
            {{ help }}
        </span>
    </fieldset>

</template>