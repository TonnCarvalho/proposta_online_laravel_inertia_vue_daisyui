<script setup>
const model = defineModel();

const emit = defineEmits(['blur'])
const props = defineProps({
    label: String,
    error: String,
    help: String,
    type: {
        type: String,
        default: 'text'
    },
    name: String,
    placeholder: String,
    icon: [String, Array],
    required: {
        type: Boolean,
        default: false
    },
    maxlength: {
        type: Number,
        default: null
    },
    mask: {
        type: Function,
        default: null
    },
    optional: String,
});

const handleInput = (event) => {
    let value = event.target.value;

    if (props.mask) {
        value = props.mask(value);
    }

    model.value = value;
};
</script>

<template>
    <fieldset class="fieldset">
        <legend :for="name"
            class="block mb-1 text-sm font-semibold">
            {{ label }}
            <span v-if="required"
                class="text-error">
                *
            </span>
        </legend>

        <input :id="name"
            :name="name"
            :type="type"
            :value="model"
            :placeholder="placeholder"
            @input="handleInput"
            @blur="$emit('blur', $event)"
            :maxlength="maxlength"
            class="input w-full text-base-content"
            :class="{ 'border border-error': $page.props.errors[name] }" />

        <p class="label">{{ optional }}</p>

        <div v-if="$page.props.errors[name]">
            <p class="text-sm text-error">
                {{ $page.props.errors[name] }}
            </p>
        </div>
    </fieldset>
</template>