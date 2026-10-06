<script setup>
import Modal from '@/components/modal/Modal.vue';
import { FileText, Info, RotateCcw, User2 } from '@lucide/vue';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

const dialog = ref(null)
const dadosProposta = ref(null)
const propostaId = ref(null)
const formProcessing = ref(false)

function showModal(dados) {
    dadosProposta.value = dados
    propostaId.value = dados.id_proposta
    dialog.value.showModal()
}

function closeModal() {
    dialog.value.closeModal()
}
defineExpose({ showModal, closeModal })

function reativarProposta() {
    router.patch(
        route('proposta.status.reativar', propostaId.value), {
    },
        {
            preserveScroll: true,
            onStart: () => {
                formProcessing.value = true
            },
            onFinish: () => {
                formProcessing.value = false
                closeModal()
            },
            onError: (error) => {
                console.log(error)
            }
        },
    )
}
</script>

<template>
    <div>
        <Modal ref="dialog">
            <template #header>
                <div class="flex items-center gap-3">
                    <span class="p-2 rounded-full bg-success/15 text-success">
                        <RotateCcw />
                    </span>
                    Reativar Proposta
                </div>
            </template>
            <template #content>
                <div class="p-3 rounded-lg bg-success/15 text-success-content mt-5">
                    <div class="flex items-center gap-3">
                        <User2 />
                        Associado:
                        <span class="text-neutral font-semibold">
                            {{ dadosProposta?.associado_nome }}
                        </span>
                    </div>
                    <div class="divider divider-success"></div>
                    <div class="flex items-center gap-3">
                        <FileText />
                        Nº Proposta:
                        <span class="text-neutral font-semibold">
                            {{ dadosProposta?.num_proposta }}
                        </span>
                    </div>
                </div>

                <div role="alert"
                    class="alert bg-primary/15 text-primary alert-soft mt-5">
                    <Info />
                    <span class="text-base-content">
                        Está proposta voltará para o status
                        <span class="text-primary">Em Andamento</span>
                    </span>
                </div>
            </template>
            <template #action>
                <button @click="closeModal"
                    :disabled="formProcessing"
                    class="btn btn-soft">
                    Voltar
                </button>

                <button @click="reativarProposta"
                    :disabled="formProcessing"
                    class="btn btn-success w-1/3">
                    {{ formProcessing ? 'Reativando' : 'Reativar' }}
                </button>
            </template>
        </Modal>
    </div>
</template>
