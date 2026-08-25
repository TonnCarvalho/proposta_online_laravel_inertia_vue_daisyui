<script setup>
import Card from '@/components/card/Card.vue';
import CardBody from '@/components/card/CardBody.vue';
import CardTitle from '@/components/card/CardTitle.vue';
import { Download, File, FileInput } from '@lucide/vue';
import { ref } from 'vue';

const props = defineProps({
    documentos: {
        type: Array,
        required: true
    }
})

const documentoSelecionado = ref(null);

function visualizarDocumento(item) {
    documentoSelecionado.value = item;
    document.getElementById('ver_documento').showModal();
}

</script>
<template>

    <Card>
        <CardBody>
            <CardTitle title="Documentos do associado" />
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-3">
                <div v-for="item in documentos"
                    :key="item.titulo">
                    <Card v-if="item.url">
                        <div class="p-3">
                            <div class="font-bold">
                                {{ item.titulo }}
                            </div>

                            <button class="cursor-pointer"
                                @click="visualizarDocumento(item)">

                                <img v-if="item.tipo === 'imagem'"
                                    class="w-full h-32 object-cover"
                                    :src="item.url"
                                    :alt="item.titulo">

                                <div class="app"
                                    v-if="item.tipo === 'pdf'">
                                    <File :size="160"
                                        :strokeWidth="1">
                                        <text x="5"
                                            y="19"
                                            font-size="7"
                                            color="#fb2c36"
                                            font-family="Verdana,sans-serif"
                                            :stroke-width="1">
                                            PDF
                                        </text>
                                    </File>
                                </div>

                            </button>
                            <div class="mt-2 w-full">
                                <button class="btn btn-sm btn-outline btn-primary w-full mb-3">
                                    <FileInput size="14" />
                                    Mudar
                                </button>
                                <button class="btn btn-sm btn-outline btn-secondary w-full">
                                    <Download size="14" />
                                    Baixar
                                </button>
                            </div>
                        </div>

                    </Card>


                </div>
            </div>
        </CardBody>
    </Card>



    <dialog id="ver_documento"
        class="modal">
        <div class="modal-box min-w-4/5">
            <h3 class="text-lg font-bold">
                {{ documentoSelecionado?.titulo }}
            </h3>

            <iframe :src="documentoSelecionado?.url"
                class="w-full h-[80vh]">
            </iframe>

        </div>
        <form method="dialog"
            class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

</template>