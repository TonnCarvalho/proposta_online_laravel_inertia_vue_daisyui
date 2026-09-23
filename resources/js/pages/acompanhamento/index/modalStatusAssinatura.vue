<script setup>
import { ref } from 'vue';
import Modal2 from '@/components/modal/Modal2.vue';
import { listaStatusAssinatura } from '@/consts/statusAssinatura'

const modal = ref(null)
const item = ref(null)
const statusSelecionado = ref(null);

function showModal(dados) {
    item.value = dados;
    statusSelecionado.value = dados.status_assinatura
    modal.value.showModal();
}

function closeModal() {
    modal.value.closeModal()
}

defineExpose({ showModal, closeModal })

function classeDaOpcao(status) {
    if (statusSelecionado.value === status.id) {
        return status.cor
    }
    return 'border-base-300 hover:bg-base-200'
}

</script>
<template>

    <Modal2 ref="modal">
        <template #header>
            {{ item?.associado_nome }}
        </template>

        <template #content>
            <div class="grid grid-cols- place-items-center gap-3">
                <label v-for="status in listaStatusAssinatura"
                    :key="status.id"
                    class="cursor-pointer w-1/2">

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
            <button class="btn btn-success btn-wide">
                Salvar
            </button>

            <button class="btn btn-soft" @click="closeModal">
                Voltar
            </button>
        </template>
    </Modal2>

</template>