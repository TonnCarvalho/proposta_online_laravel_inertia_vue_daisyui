<script setup>
import {
    BadgeCheck,
    CircleDashed,
    DollarSign,
    FileCheck,
    FileCheckCorner,
    FileClock,
    FileExclamationPoint,
    FileMinus,
    FilePenLine,
    FileX,
    Loader,
    X,
} from '@lucide/vue';

const props = defineProps({
    id: String,
    statusProposta: Array,
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
        class: 'peer-checked:bg-orange-500 peer-checked:text-white peer-checked:border-orange-500',
    },

    4: {
        icon: FileMinus,
        class: 'peer-checked:bg-cyan-600 peer-checked:text-white peer-checked:border-cyan-600',
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
        icon: 'Send',
        class: 'peer-checked:bg-indigo-600 peer-checked:text-white peer-checked:border-indigo-600',
    },

    9: {
        icon: DollarSign,
        class: 'peer-checked:bg-lime-800 peer-checked:text-white peer-checked:border-lime-800',
    },

    10: {
        icon: BadgeCheck,
        class: 'peer-checked:bg-green-700 peer-checked:text-white peer-checked:border-green-700',
    },

}

</script>
<template>
    <dialog :id="id"
        class="modal">
        <div class="modal-box min-w-1">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">
                    <X size="15" />
                </button>
            </form>

            <h3 class="text-lg font-bold">
                Mudar situação da proposta
            </h3>

            <div class="flex flex-wrap gap-3">
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

            <div class="modal-action">
                <button class="btn btn-primary">
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