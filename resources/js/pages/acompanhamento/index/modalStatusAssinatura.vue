<script setup>

import { FileXCorner, FilePenLine, FileCheckCorner, X } from '@lucide/vue';

import { ref } from 'vue';
import { computed } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    propostaId: {
        type: Number,
    },
    statusAssinatura: Number,
})

const dialog = ref(null)

function showModal() {
    dialog.value.showModal()
}

function closeModal() {
    dialog.value.close()
}
defineExpose({
    showModal,
    closeModal,
})

const statusSelecionado = defineModel();
const statusMap = {

    1: {
        label: 'Não enviado',
        class: 'bg-red-600 text-white border-red-600',
        icon: FileXCorner,
    },
    2: {
        label: 'Aguardando assinatura',
        class: 'bg-sky-600 text-white border-sky-600',
        icon: FilePenLine,
    },
    3: {
        label: 'Assinado',
        class: 'bg-emerald-600 text-white border-emerald-600',
        icon: FileCheckCorner,
    },

}
const statusConfig = computed(() => {
    return statusMap[props.status]
})

const salvarStatus = () => {

    router.patch(
        route('proposta.status.update', props.propostaId),
        {
            // status: statusSelecionado.value,
        },
        {
            preserveScroll: true,

            onSuccess: () => {
                closeModal();
            }
        }
    )
}
</script>
<template>
    <dialog ref="dialog"
        class="modal">
        <div class="modal-box min-w-1">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">
                    <X size="15" />
                </button>
            </form>

            <h3 class="text-lg font-bold mb-3">
                Mudar situação da proposta {{ statusAssinatura }}
            </h3>

            <div class="flex flex-col items-center  gap-3">
                <label class="cursor-pointer w-1/2"
                    v-for="status in statusMap"
                    :key="status.label">

                    <input v-model="statusSelecionado"
                        type="radio"
                        :value="status"
                        name="status_proposta"
                        class="peer hidden">

                    <div class="flex items-center gap-2 rounded-lg border border-base-300 px-4 py-2 text-sm transition"
                        :class="statusConfig[statusAssinatura]">
                        <component :is="status.icon" />
                        {{ status.label }}
                    </div>
                </label>
            </div>


            <div class="modal-action justify-start">
                <button @click="salvarStatus(statusSelecionado.value)"
                    class="btn btn-primary btn-wide">
                    Salvar
                </button>
                <form method="dialog">
                    <button class="btn">Fechar</button>
                </form>
            </div>
        </div>

        <form method="dialog"
            class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
</template>