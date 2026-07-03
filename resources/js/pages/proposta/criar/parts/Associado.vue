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
})

const sexo = [
    { label: 'Masculino', value: 'M' },
    { label: 'Feminino', value: 'F' },
]

const estadoCivil = [
    { label: 'Solteiro (a)', value: 'solteiro' },
    { label: 'Casado (a)', value: 'casado' },
    { label: 'Diverciado (a)', value: 'divorciado' },
    { label: 'Viuvo (a)', value: 'viuvo' },
]

const ocupacao = [
    { label: 'Ativo (a)', value: 'ativo' },
    { label: 'Aposentado (a)', value: 'aposentado' },
    { label: 'Pensionista (a)', value: 'pensionista' },
]

const orgaos = ref([]);
const carregandoOrgaos = ref(false);

watch(
    () => props.formAssociado.cod_local,
    async (novoCodLocal) => {
        // Sempre limpa o órgão quando trocar a praça
        props.formAssociado.cod_orgao = '';
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
            console.error(error);
            orgaos.value = [];
        } finally {
            carregandoOrgaos.value = false;
        }
    }
);

</script>

<template>
    <Card>
        <CardBody>
            <CardTitle title="Dados do associado" />
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-2">

                <Input label="Nome completo"
                    v-model="formAssociado.nome"
                    :maxlength="100"
                    required />

                <Input label="CPF"
                    v-model="formAssociado.cpf"
                    :mask="maskCpf"
                    :maxlength="14"
                    required />
                <Select label="Praça"
                    placeholder="Selecione"
                    v-model="formAssociado.cod_local"
                    :items="props.origens"
                    :valueKey="item => item.cod_local"
                    :labelKey="item => item.nome"
                    required />

                <Select label="Órgão"
                    v-model="formAssociado.cod_orgao"
                    placeholder="Selecione"
                    :items="orgaos"
                    :valueKey="item => item.cod_orgao"
                    :labelKey="item => `${item.cod_orgao} - ${item.nome}`"
                    :disabled="!props.formAssociado.cod_local || carregandoOrgaos"
                    optional="Muda com a praça"
                    required />


                <Input label="RG"
                    v-model="formAssociado.rg"
                    :maxlength="14"
                    required />

                <Input label="Órgão expedidor"
                    v-model="formAssociado.org_exp"
                    :maxlength="10"
                    required />

                <Input label="Email"
                    v-model="formAssociado.email"
                    type="email"
                    optional="Envio de assinatura por Email"
                    :maxlength="50"
                    required />

                <Input label="Data de nascimento"
                    v-model="formAssociado.data_nasc"
                    :mask="maskDate"
                    :maxlength="10"
                    required />

                <Input label="Naturalidade"
                    v-model="formAssociado.nat"
                    :maxlength="50"
                    required />

                <Select label="Sexo"
                    v-model="formAssociado.sexo"
                    :items="sexo"
                    :valueKey="item => item.value"
                    :labelKey="item => item.label"
                    placeholder="Selecione"
                    required />

                <Input label="Celular contato (WhatsApp)"
                    v-model="formAssociado.cel"
                    :mask="maskPhone"
                    :maxlength="15"
                    optional="Envio de assinatura por WhatsApp"
                    required />

                <Input label="Nome do pai"
                    v-model="formAssociado.nome_pai"
                    :maxlength="100" />

                <Input label="Nome da mãe"
                    v-model="formAssociado.nome_mae"
                    :maxlength="100"
                    required />

                <Select label="Estado civil"
                    v-model="formAssociado.estado_civil"
                    placeholder="Selecione"
                    :items="estadoCivil"
                    :valueKey="item => item.value"
                    :labelKey="item => item.label"
                    required />

                <Input label="Matrícula"
                    v-model="formAssociado.mat"
                    :maxlength="50"
                    required />

                <Input label="Setor"
                    v-model="formAssociado.setor"
                    :maxlength="50"
                    required />

                <Input label="Cargo"
                    :maxlength="50"
                    v-model="formAssociado.cargo"
                    required />

                <Select label="Ocupação"
                    v-model="formAssociado.ocupacao"
                    placeholder="Selecione"
                    :items="ocupacao"
                    :valueKey="item => item.value"
                    :labelKey="item => item.label"
                    required />

                <Input label="Data de admissão"
                    v-model="formAssociado.data_admissao"
                    :mask="maskDate"
                    :maxlength="10"
                    required />
            </div>
        </CardBody>
    </Card>
</template>