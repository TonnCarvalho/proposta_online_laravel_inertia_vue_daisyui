<script setup>
import Modal from '@/components/modal/Modal.vue';
import { CircleArrowUp, FileText, Info, RotateCcw, User2 } from '@lucide/vue';
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
                    <span class="p-2 rounded-full bg-primary/15 text-primary">
                        <CircleArrowUp />
                    </span>
                    Enviar Click Sign
                </div>
            </template>
            <template #content>
                <div class="p-3 rounded-lg bg-primary/15 text-primary mt-5">
                    <div class="flex items-center gap-3">
                        <User2 />
                        Associado:
                        <span class="font-bold">
                            {{ dadosProposta?.associado.nome }}
                        </span>
                    </div>
                    <div class="divider divider-primary my-0"></div>
                    <div class="flex items-center gap-3">
                        <FileText />
                        Nº Proposta:
                        <span class="font-bold">
                            {{ dadosProposta?.num_proposta }}
                        </span>
                    </div>
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
                    class="btn btn-primary w-1/3">
                    {{ formProcessing ? 'Enviando' : 'Enviar' }}
                </button>
            </template>
        </Modal>
    </div>
</template>
