<script setup>
import { ref, } from 'vue';
import { router } from '@inertiajs/vue3';
import Modal from '@/components/modal/Modal.vue';
import { listaStatusAssinatura } from '@/consts/statusAssinatura'
import { FilePen } from '@lucide/vue';

const dialog = ref(null)
const dadosProposta = ref(null)
const statusSelecionado = ref(null);
const propostaId = ref(null);

const formProcessing = ref(false);

function showModal(dados) {
    dadosProposta.value = dados;
    statusSelecionado.value = dados.status_assinatura
    propostaId.value = dados.id_proposta
    dialog.value.showModal();
}

function closeModal() {
    dialog.value.closeModal()
}

defineExpose({ showModal, closeModal })

function classeDaOpcao(status) {
    if (statusSelecionado.value === status.id) {
        return status.cor
    }
    return 'border-base-300 hover:bg-base-200'
}

function salvarStatus() {
    router.patch(
        route('proposta.statusAssinaura.update', propostaId.value),
        {
            status: statusSelecionado.value
        },
        {
            preserveScroll: true,
            onStart: () => {
                formProcessing.value = true
            },
            onSuccess: () => {
                closeModal();
            },
            onFinish: () => {
                formProcessing.value = false
            }
        }
    )
}

</script>
<template>
    <Modal ref="dialog">
        <template #header>
            <div class="flex items-center gap-3">
                <span class="p-2 rounded-full bg-orange-100 text-orange-500">
                    <FilePen />
                </span>
                Status da assinatura
            </div>
        </template>

        <template #content>
            <div class="p-3 rounded-lg bg-orange-100 text-orange-500 mt-5">
                <div class="flex items-center gap-3">
                    <User2 />
                    Associado:
                    <span class="font-bold">
                        {{ dadosProposta?.associado_nome }}
                    </span>
                </div>
                <div class="divider divider-warning my-0"></div>
                <div class="flex items-center gap-3">
                    <FileText />
                    Nº Proposta:
                    <span class="font-bold">
                        {{ dadosProposta?.num_proposta }}
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 place-items-center gap-3 mt-3">
                <label v-for="status in listaStatusAssinatura"
                    :key="status.id"
                    class="cursor-pointer w-2/3">

                    <input type="radio"
                        v-model="statusSelecionado"
                        name="status_proposta"
                        :value="status.id"
                        class="hidden">

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
                @click="closeModal"
                :disabled="formProcessing">
                Cancelar
            </button>
            <button @click.prevent="salvarStatus()"
                :disabled="formProcessing"
                class="btn btn-success w-1/3">

                {{ formProcessing ? 'Salvando' : 'Salvar' }}

                <span v-if="formProcessing"
                    class="loading loading-spinner loading-sm">
                </span>
            </button>
        </template>
    </Modal>

</template>