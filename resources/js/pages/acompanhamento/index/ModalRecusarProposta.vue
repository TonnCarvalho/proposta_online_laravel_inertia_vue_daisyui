<script setup>
import Modal from '@/components/modal/Modal.vue';
import { router } from '@inertiajs/vue3';
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

defineExpose({ showModal })

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
        }


    )
}
</script>

<template>
    <Modal ref="dialog">
        <template #header>
            <div class="text-error">
                Deseja recusar a proposta?
            </div>
        </template>
        <template #content>
            <fieldset class="fieldset">
                <legend class="block mb-1 text-sm font-semibold">
                    Associado
                </legend>
                <input type="text"
                    :value="dadosProposta?.associado_nome"
                    class="input input-sm input-ghost w-full"
                    readonly />

                <legend class="block mb-1 text-sm font-semibold">
                    Nª Proposta
                </legend>
                <input type="text"
                    :value="dadosProposta?.num_proposta"
                    class="input input-sm input-ghost w-full"
                    readonly />
            </fieldset>

            <fieldset class="fieldset">
                <legend class="block mb-1 text-sm font-semibold">
                    Informe o motivo <span class="text-error">*</span>
                </legend>
                <textarea v-model="motivo"
                    class="textarea h-24 w-full"
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
