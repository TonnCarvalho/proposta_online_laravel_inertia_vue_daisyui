<script setup>
defineProps({
    icon: String,
    title: String,
})
</script>

<template>
    <div class="card-title p-3 flex items-center gap-1
    border-b border-base-content/20">
        <FontAwesomeIcon v-if="icon"
            :icon="['fas', icon]" />
        {{ title }}
    </div>
</template>