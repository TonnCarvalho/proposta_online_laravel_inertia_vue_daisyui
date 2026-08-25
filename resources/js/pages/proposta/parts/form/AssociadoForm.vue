<script setup>
import Card from '@/components/card/Card.vue';
import CardBody from '@/components/card/CardBody.vue';
import CardTitle from '@/components/card/CardTitle.vue';
import Input from '@/components/form/Input.vue';
import Select from '@/components/form/Select.vue';
import { maskCpf, maskDate, maskPhone } from '@/utils/masks';
import { ref, watch } from 'vue';

const props = defineProps({
    formAssociado: Object,
    origens: Object | Array,
    sexoAssociado: Array,
    estadoCivilAssociado: Array,
    ocupacaoAssociado: Array,
    errors: {
        type: Object,
        default: () => ({}),
    },
})

const orgaos = ref([]);
const carregandoOrgaos = ref(false);

watch(
    () => props.formAssociado.cod_local,
    async (novoCodLocal, codLocalAnterior) => {

        /**
         * Limpa o órgão somente quando o usuário troca a praça
         * 
         * No primeira execução, codLocalAnterior será undefined
         * Dessa forma, preservamos o cod_orgao que veio do banco.
         */
        if (codLocalAnterior !== undefined &&
            novoCodLocal !== codLocalAnterior
        ) {
            props.formAssociado.cod_orgao = ''
        }
        orgaos.value = [];

        // Se não selecionou praça, não faz requisição
        if (!novoCodLocal) {
            return;
        }

        try {
            carregandoOrgaos.value = true;

            const response = await fetch(`/orgao/por-praca/${novoCodLocal}`);

            if (!response.ok) {
                throw new Error('Erro ao buscar órgãos');
            }

            const data = await response.json();

            orgaos.value = data;
        } catch (error) {
            orgaos.value = [];
        } finally {
            carregandoOrgaos.value = false;
        }
    },
    {
        immediate: true,
    }
);

</script>

<template>
    <Card>
        <CardBody>

            <CardTitle title="Dados do associado"
                icon="User"
                class="text-primary" />

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-2">

                <Input label="Nome completo"
                    v-model="formAssociado.nome"
                    :maxlength="100"
                    :error="errors['associado.nome']"
                    required />

                <Input label="CPF"
                    v-model="formAssociado.cpf"
                    :mask="maskCpf"
                    :maxlength="14"
                    :error="errors['associado.cpf']"
                    required />

                <Select label="Praça"
                    placeholder="Selecione"
                    v-model="formAssociado.cod_local"
                    :error="errors['associado.cod_local']"
                    :items="props.origens"
                    :valueKey="item => item.cod_local"
                    :labelKey="item => item.nome"
                    required />

                <Select label="Órgão"
                    v-model="formAssociado.cod_orgao"
                    :error="errors['associado.cod_orgao']"
                    placeholder="Selecione"
                    :items="orgaos"
                    :valueKey="item => item.cod_orgao"
                    :labelKey="item => `${item.cod_orgao} - ${item.nome}`"
                    :disabled="!props.formAssociado.cod_local || carregandoOrgaos"
                    required />

                <Input label="RG"
                    v-model="formAssociado.rg"
                    :maxlength="14"
                    :error="errors['associado.rg']"
                    required />

                <Input label="Órgão expedidor"
                    v-model="formAssociado.orgao_exp"
                    :maxlength="10"
                    :error="errors['associado.orgao_exp']"
                    required />

                <Input label="Email"
                    v-model="formAssociado.email"
                    type="email"
                    optional="Envio de assinatura por Email"
                    :maxlength="50"
                    :error="errors['associado.email']"
                    required />

                <Input label="Data de nascimento"
                    v-model="formAssociado.data_nasc"
                    :mask="maskDate"
                    :maxlength="10"
                    :error="errors['associado.data_nasc']"
                    required />

                <Input label="Naturalidade"
                    v-model="formAssociado.nat"
                    :maxlength="50"
                    :error="errors['associado.nat']"
                    required />

                <Select label="Sexo"
                    v-model="formAssociado.sexo"
                    :error="errors['associado.sexo']"
                    :items="sexoAssociado"
                    :valueKey="item => item.value"
                    :labelKey="item => item.label"
                    placeholder="Selecione"
                    required />

                <Input label="Celular contato (WhatsApp)"
                    v-model="formAssociado.cel"
                    :mask="maskPhone"
                    :maxlength="15"
                    :error="errors['associado.cel']"
                    optional="Envio de assinatura por WhatsApp"
                    required />

                <Input label="Nome do pai"
                    v-model="formAssociado.nome_pai"
                    :maxlength="100" />

                <Input label="Nome da mãe"
                    v-model="formAssociado.nome_mae"
                    :maxlength="100"
                    :error="errors['associado.nome_mae']"
                    required />

                <Select label="Estado civil"
                    v-model="formAssociado.estado_civil"
                    :error="errors['associado.estado_civil']"
                    placeholder="Selecione"
                    :items="estadoCivilAssociado"
                    :valueKey="item => item.value"
                    :labelKey="item => item.label"
                    required />

                <Input label="Matrícula"
                    v-model="formAssociado.mat"
                    :maxlength="50"
                    :error="errors['associado.mat']"
                    required />

                <Input label="Setor"
                    v-model="formAssociado.setor"
                    :maxlength="50"
                    :error="errors['associado.setor']"
                    required />

                <Input label="Cargo"
                    v-model="formAssociado.cargo"
                    :maxlength="50"
                    :error="errors['associado.cargo']"
                    required />

                <Select label="Ocupação"
                    v-model="formAssociado.ocupacao"
                    :error="errors['associado.ocupacao']"
                    placeholder="Selecione"
                    :items="ocupacaoAssociado"
                    :valueKey="item => item.value"
                    :labelKey="item => item.label"
                    required />

                <Input label="Data de admissão"
                    v-model="formAssociado.data_admissao"
                    :mask="maskDate"
                    :maxlength="10"
                    :error="errors['associado.data_admissao']"
                    required />
            </div>
        </CardBody>
    </Card>
</template>