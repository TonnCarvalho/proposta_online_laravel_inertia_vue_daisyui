<script setup>

const model = defineModel();
defineProps({
    label: String,
    required: {
        type: Boolean,
        default: false
    },
    error: String,
    optional: String,
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
            class="block mb-1 text-base-content text-sm font-semibold">
            {{ label }}
            <span v-if="required"
                class="text-error">
                *
            </span>
        </legend>
        <select class="select w-full"
            :class="{ 'border border-error': error }"
            :name="name"
            v-model="model">
            <option value=""
                :disabled="placeholderDisabled">
                {{ placeholder }}
            </option>

            <option v-for="item in items"
                :key="valueKey(item)"
                :value="valueKey(item)">
                {{ labelKey(item) }}
            </option>

        </select>
        <span v-if="optional"
            class="label">
            {{ optional }}
        </span>

        <div v-if="error">
            <p class="text-sm text-error">
                {{ error }}
            </p>
        </div>
    </fieldset>

</template>