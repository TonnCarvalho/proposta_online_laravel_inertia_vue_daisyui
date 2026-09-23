<script setup>
import {
    BadgeCheck,
    DollarSign,
    FileCheck,
    FileCheckCorner,
    FileClock,
    FileExclamationPoint,
    FileMinus,
    FilePenLine,
    FileText,
    FileX,
    Loader,
    X,
} from '@lucide/vue';

import { ref } from 'vue';

import { router } from '@inertiajs/vue3';

const props = defineProps({
    propostaId: {
        type: Number,
    },
    statusProposta: Array,
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
const statusConfig = {

    0: {
        icon: FileX,
        class: 'peer-checked:bg-red-600 peer-checked:text-white peer-checked:border-red-600',
    },

    1: {
        icon: Loader,
        class: 'peer-checked:bg-blue-600 peer-checked:text-white peer-checked:border-blue-600',
    },

    2: {
        icon: FileClock,
        class: 'peer-checked:bg-purple-600 peer-checked:text-white peer-checked:border-purple-600',
    },

    3: {
        icon: FileExclamationPoint,
        class: 'peer-checked:bg-yellow-500 peer-checked:text-white peer-checked:border-yellow-500',
    },

    4: {
        icon: FileMinus,
        class: 'peer-checked:bg-cyan-500 peer-checked:text-white peer-checked:border-cyan-500',
    },

    5: {
        icon: FileCheck,
        class: 'peer-checked:bg-green-500 peer-checked:text-white peer-checked:border-green-500',
    },

    6: {
        icon: FilePenLine,
        class: 'peer-checked:bg-sky-600 peer-checked:text-white peer-checked:border-sky-600',
    },

    7: {
        icon: FileCheckCorner,
        class: 'peer-checked:bg-emerald-600 peer-checked:text-white peer-checked:border-emerald-600',
    },

    8: {
        icon: FileText,
        class: 'peer-checked:bg-gray-600 peer-checked:text-white peer-checked:border-gray-600',
    },

    9: {
        icon: DollarSign,
        class: 'peer-checked:bg-indigo-500 peer-checked:text-white peer-checked:border-indigo-500',
    },

    10: {
        icon: BadgeCheck,
        class: 'peer-checked:bg-green-700 peer-checked:text-white peer-checked:border-green-700',
    },

}

const salvarStatus = () => {

    router.patch(
        route('proposta.status.update', props.propostaId),
        {
            status: statusSelecionado.value,
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
                Mudar situação da proposta
            </h3>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                <label v-for="status in statusProposta"
                    :key="status.value"
                    class="cursor-pointer">

                    <input v-model="statusSelecionado"
                        type="radio"
                        name="status_proposta"
                        :value="status.value"
                        class="peer hidden">

                    <div class="
                flex items-center gap-2
                rounded-lg border border-base-300
                px-4 py-2
                text-sm
                transition"
                        :class="statusConfig[status.value]?.class">
                        <component :is="statusConfig[status.value]?.icon"
                            class="size-4" />

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