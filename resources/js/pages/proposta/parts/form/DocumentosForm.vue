<script setup>
import Card from '@/components/card/Card.vue';
import CardBody from '@/components/card/CardBody.vue';
import CardTitle from '@/components/card/CardTitle.vue';

const props = defineProps({
    formDocumento: Object,
})

const inputDocument = [
    {
        label: 'Frente do documento',
        name: 'frenteDocumento',
        required: false,
        maxSize: '5 MB'
    },
    {
        label: 'Verso do documento',
        name: 'versoDocumento',
        required: false,
        maxSize: '5 MB'
    },
    {
        label: 'Contra Cheque',
        name: 'contraCheque',
        required: false,
        maxSize: '5 MB'
    },
    {
        label: 'Comprovante bancario',
        name: 'comprovanteBancario',
        required: false,
        maxSize: '5 MB'
    },

    {
        label: 'Comprovante de residência',
        name: 'comprovanteResidencia',
        required: false,
        maxSize: '5 MB'
    },
    {
        label: 'Consulta receita federal',
        name: 'consultaReceitaFederal',
        required: false,
        maxSize: '5 MB'
    },
    {
        label: 'Averbação de benefício',
        name: 'averbacaoBeneficio',
        required: false,
        maxSize: '5 MB'
    },
    {
        label: 'Averbação de mensalidade',
        name: 'averbacaoMensalidade',
        required: false,
        maxSize: '5 MB'
    },
    {
        label: 'Outros documentos',
        name: 'outrosDocumentos',
        required: false,
        maxSize: '5 MB'
    },
]

</script>


<template>
    <Card>
        <CardBody>

            <CardTitle title="Documentos do associado"
                icon="Files" />

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">

                <fieldset v-for="item in inputDocument" :key="item.name"
                    class="fieldset">

                    <legend class="block mb-1 text-sm font-semibold">
                        {{ item.label }}
                        <span v-if="item.required"
                            class="text-error"> *</span>
                    </legend>

                    <input type="file"
                        @input="formDocumento[item.name] = $event.target.files[0]"
                        class="file-input w-full"
                        :id="item.name"
                        :name="item.name"
                        accept=".jpg, .jpeg, .png, .gif, .pdf" />

                    <label class="label">
                        Tamanho máximo {{ item.maxSize }}
                    </label>

                </fieldset>
            </div>

        </CardBody>
    </Card>

</template>