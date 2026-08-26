<script setup>

const props = defineProps({
    titulo: String,
    id: String,
})
</script>
<template>
    <dialog :id="id"
        class="modal">
        <div class="modal-box min-w-4/5">
            <h3 v-if="titulo" class="text-lg font-bold">
                {{ titulo }}
            </h3>   
            <slot />
        </div>

        <form method="dialog"
            class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
</template>