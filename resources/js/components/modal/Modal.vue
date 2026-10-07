<script setup>
import { ref } from 'vue';

const dialog = ref(null)

function showModal() {
    dialog.value.showModal()
}

function closeModal() {
    dialog.value.close()
}

defineExpose({ showModal, closeModal })

defineProps({
    tamanho: {
        type: String,
        default: 'min-w-1',
    },
})

</script>
<template>
    <dialog ref="dialog"
        class="modal">
        <div class="modal-box" :class="tamanho">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">
                    x
                </button>
            </form>

            <h3 class="text-lg font-bold mb-3">
                <slot name="header"></slot>
            </h3>
            
            <slot name="content"></slot>

            <div class="modal-action">
                <slot name="action"></slot>
            </div>
        </div>

        <form method="dialog"
            class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
</template>