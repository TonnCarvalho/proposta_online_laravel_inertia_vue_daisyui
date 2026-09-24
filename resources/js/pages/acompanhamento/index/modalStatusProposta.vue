<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import Modal2 from '@/components/modal/Modal2.vue';
import { listaStatusProposta } from '@/consts/statusProposta';

const dialog = ref(null)
const dadosProposta = ref(null)
const statusSelecionado = ref(null)
const propostaId = ref(null)

function showModal(dados) {
    dadosProposta.value = dados
    statusSelecionado.value = dados.status_proposta
    propostaId.value = dados.id_proposta
    dialog.value.showModal()
}

function closeModal() {
    dialog.value.closeModal()
}
defineExpose({ showModal, closeModal })

function classeDaOpcao(status) {
    if (statusSelecionado.value === status.id) {
        return status.class
    }
    return 'border-base-300 hover:bg-base-200'
}
const salvarStatus = () => {
    router.patch(
        route('proposta.status.update', propostaId.value),
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
    <Modal2 ref="dialog">

        <template #header>
            Status da proposta
        </template>

        <template #content>
            <div class="text-neutral-500">
                <span class="font-semibold">Associado:</span>
                {{ dadosProposta?.associado_nome }}
            </div>
            <div class="text-neutral-500">
                <span class="font-semibold">Nª Proposta:</span>
                {{ dadosProposta?.num_proposta }}
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 mt-3">
                <label v-for="status in listaStatusProposta"
                    :key="status.id"
                    class="cursor-pointer">

                    <input type="radio"
                        v-model="statusSelecionado"
                        name="status_proposta"
                        :value="status.id"
                        class="peer hidden">

                    <div class="flex items-center gap-2 rounded-lg border border-base-300 px-4 py-2 text-sm transition"
                        :class="classeDaOpcao(status)">

                        <component :is="status.icon" />
                        {{ status.label }}

                    </div>
                </label>
            </div>
        </template>

        <template #action>
            <button class="btn btn-soft"
                @click="closeModal">
                Cancelar
            </button>
            <button @click.prevent="salvarStatus()"
                class="btn btn-success w-1/3">
                Salvar
            </button>
        </template>
    </Modal2>
</template>