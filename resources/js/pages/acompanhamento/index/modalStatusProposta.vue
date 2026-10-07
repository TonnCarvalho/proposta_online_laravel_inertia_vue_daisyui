<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import Modal from '@/components/modal/Modal.vue';
import { listaStatusProposta } from '@/consts/statusProposta';
import { FileText, RefreshCcw, User2 } from '@lucide/vue';
const dialog = ref(null)
const dadosProposta = ref(null)
const statusSelecionado = ref(null)
const propostaId = ref(null)

const formProcessing = ref(false);

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

function salvarStatus() {
    router.patch(
        route('proposta.status.update', propostaId.value),
        {
            status: statusSelecionado.value,
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
                <span class="p-2 rounded-full bg-primary/15 text-primary">
                    <RefreshCcw />
                </span>
                Mudar status da proposta
            </div>
        </template>

        <template #content>
            <div class="p-3 rounded-lg bg-primary/15 text-primary mt-5">
                <div class="flex items-center gap-3">
                    <User2 />
                    Associado:
                    <span class="font-bold">
                        {{ dadosProposta?.associado_nome }}
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