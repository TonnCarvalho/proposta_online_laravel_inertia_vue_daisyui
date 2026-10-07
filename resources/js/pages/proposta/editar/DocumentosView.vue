<script setup>
import Card from '@/components/card/Card.vue';
import CardBody from '@/components/card/CardBody.vue';
import CardTitle from '@/components/card/CardTitle.vue';
import { Download, Trash } from '@lucide/vue';
import { ref } from 'vue';

const props = defineProps({
    documentos: {
        type: Array,
        required: true
    },
    imagemVersao: String,
})


const dialog = ref(null);
const itemModal = ref(null)
const documentoSelecionado = ref(null);

function openModal(item) {
    itemModal.value = item
    documentoSelecionado.value = item.url
    dialog.value.showModal();
}

</script>
<template>

    <Card class="mb-3">
        <CardBody>
            <CardTitle title="Documentos"
                icon="FileUser" />
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-3">
                <div v-for="item in documentos"
                    :key="item.titulo">
                    <Card v-if="item.url"
                        class="">
                        <div class="p-3">
                            <div class="font-bold">
                                {{ item.titulo }}
                            </div>
                            <button class="cursor-pointer w-full"
                                @click="openModal(item)">

                                <img v-if="item.tipo === 'imagem'"
                                    class="w-full min-h-32 max-h-32 mx-auto object-contain"
                                    :src="`${item.url}?v=${imagemVersao}`"
                                    :alt="item.titulo">

                                <img v-if="item.tipo === 'pdf'"
                                    class="w-full min-h-32 max-h-32 mx-auto object-contain"
                                    src="../../../assets/images/proposta/pdf.png"
                                    :alt="item.titulo">
                            </button>

                            <div class="mt-2 w-full grid grid-cols-1 gap-3">
                                <a :href="item.download"
                                    class="btn btn-sm btn-outline btn-primary w-full">
                                    <Download size="14" />
                                    Baixar
                                </a>
                                <a :href="item.deleta"
                                    class="btn btn-sm btn-outline btn-secondary w-full">
                                    <Trash size="14" />
                                    Apagar
                                </a>
                            </div>

                        </div>
                    </Card>
                </div>
            </div>
        </CardBody>
    </Card>

    <dialog ref="dialog"
        class="modal">
        <div class="modal-box min-w-5xl">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">
                    x
                </button>
            </form>

            <h3 class="text-lg font-bold mb-3">
                {{ itemModal?.titulo }}
            </h3>

            <div class="modal-action">

                <iframe v-if="itemModal?.tipo == 'pdf'"
                    :src="documentoSelecionado"
                    class="w-full h-[84vh]">
                </iframe>

                <img v-if="itemModal?.tipo != 'pdf'"
                    :src="documentoSelecionado"
                    class="w-full h-[84vh] object-contain" />
            </div>
        </div>

        <form method="dialog"
            class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
</template>