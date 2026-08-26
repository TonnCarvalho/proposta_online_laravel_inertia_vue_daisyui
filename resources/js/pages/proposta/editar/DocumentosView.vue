<script setup>
import Card from '@/components/card/Card.vue';
import CardBody from '@/components/card/CardBody.vue';
import CardTitle from '@/components/card/CardTitle.vue';
import Modal from '@/components/modal/Modal.vue';
import { Download, Trash } from '@lucide/vue';
import { ref } from 'vue';

const props = defineProps({
    documentos: {
        type: Array,
        required: true
    },
    imagemVersao: String,
})

const documentoSelecionado = ref(null);

function visualizarDocumento(item) {
    documentoSelecionado.value = item;
    document.getElementById('ver_documento').showModal();
}

</script>
<template>

    <Card class="mb-3">
        <CardBody>
            <CardTitle title="Documentos" icon="FileUser" />
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
                                @click="visualizarDocumento(item)">

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

    <Modal id="ver_documento"
        :titulo="documentoSelecionado?.titulo">

        <iframe :src="documentoSelecionado?.url"
            class="w-full h-[85vh]">
        </iframe>
    </Modal>

</template>