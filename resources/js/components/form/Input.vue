<script setup>
const model = defineModel();

defineProps({
    label: String,
    error: String,
    help: String,
    type: {
        type: String,
        default: 'text'
    },
    name: String,
    placeholder: String,
    icon: String | Array,
})
</script>

<template>
    <fieldset class="fieldset">
        <legend :for="name"
            class="block mb-1 text-sm font-semibold">
            {{ label }}
        </legend>
        <input :name="name"
            :type="type"
            v-model="model"
            :id="name"
            :placeholder="placeholder"
            class="input w-full text-base-content"
            :class="{ 'border border-error': $page.props.errors[name] }" />

        <div v-if="$page.props.errors[name]">
            <p class="text-sm text-error">
                {{ $page.props.errors[name] }}
            </p>
        </div>
    </fieldset>
</template>