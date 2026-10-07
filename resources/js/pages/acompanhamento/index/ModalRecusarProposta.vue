<script setup>
import Modal from '@/components/modal/Modal.vue';
import { router } from '@inertiajs/vue3';
import { FileText, Trash, User2 } from '@lucide/vue';
import { ref } from 'vue';

const dialog = ref(null)
const dadosProposta = ref(null)
const propostaId = ref(null)
const motivo = ref(null);
const formProcessing = ref(false);

function showModal(dados) {
    dadosProposta.value = dados;
    propostaId.value = dados.id_proposta;
    dialog.value.showModal();
}

function closeModal() {
    dialog.value.closeModal()
}

defineExpose({ showModal, closeModal })

function recusarProposta() {
    router.patch(
        route('proposta.status.recusar', propostaId.value), {
        motivo: motivo.value,
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
                motivo.value = ''
            }
        })
}
</script>

<template>
    <Modal ref="dialog">
        <template #header>
            <div class="flex items-center gap-3">
                <span class="p-2 rounded-full bg-error/15 text-error">
                    <Trash />
                </span>
                Recusar Proposta
            </div>
        </template>
        <template #content>
            <div class="p-3 rounded-lg bg-error/15 text-error-content mt-5">
                <div class="flex items-center gap-3">
                    <User2 />
                    Associado:
                    <span class="font-bold">
                        {{ dadosProposta?.associado_nome }}
                    </span>
                </div>
                <div class="divider divider-error my-0"></div>
                <div class="flex items-center gap-3">
                    <FileText />
                    Nº Proposta:
                    <span class="font-bold">
                        {{ dadosProposta?.num_proposta }}
                    </span>
                </div>
            </div>

            <fieldset class="fieldset mt-5">
                <legend class="block mb-1 text-sm font-semibold">
                    Informe o motivo <span class="text-error">*</span>
                </legend>
                <textarea v-model="motivo"
                    class="textarea h-24 w-full border-red-500 focus:outline-red-500"
                    placeholder="Motivo"></textarea>
            </fieldset>
        </template>

        <template #action>
            <button @click="closeModal"
                :disabled="formProcessing"
                class="btn btn-soft">
                Volta
            </button>

            <button @click="recusarProposta"
                :disabled="formProcessing"
                class="btn btn-error w-1/3">
                {{ formProcessing ? 'Recusando' : 'Recusar' }}

                <span v-if="formProcessing"
                    class="loading loading-spinner loading-sm">
                </span>
            </button>
        </template>
    </Modal>
</template>
