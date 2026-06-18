<script setup>
import Card from '@/components/card/Card.vue';
import CardBody from '@/components/card/CardBody.vue';
import CardTitle from '@/components/card/CardTitle.vue';
import Input from '@/components/form/Input.vue';
import Select from '@/components/form/Select.vue';
import { maskCpf, maskDate, maskPhone } from '@/utils/masks';

const props = defineProps({
    associado: Object,
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

</script>

<template>
    <Card>
        <CardBody>
            <CardTitle title="Dados do associado" />
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">

                <Input label="Nome completo"
                    v-model="associado.nome"
                    :maxlength="100"
                    required />

                <Input label="CPF"
                    v-model="associado.cpf"
                    :mask="maskCpf"
                    :maxlength="14"
                    required />

                <Select label="Praça"
                    required />

                <Input label="RG"
                    v-model="associado.rg"
                    :maxlength="14"
                    required />

                <Input label="Órgão expedidor"
                    v-model="associado.org_exp"
                    :maxlength="10"
                    required />

                <Input label="Email"
                    v-model="associado.email"
                    type="email"
                    optional="Envio de assinatura por Email"
                    :maxlength="50"
                    required />

                <Input label="Data de nascimento"
                    v-model="associado.data_nasc"
                    :mask="maskDate"
                    :maxlength="10"
                    required />

                <Input label="Naturalidade"
                    v-model="associado.nat"
                    :maxlength="50"
                    required />

                <Select label="Sexo"
                    v-model="associado.sexo"
                    :items="sexo"
                    :valueKey="item => item.value"
                    :labelKey="item => item.label"
                    placeholder="Selecione"
                    required />

                <Input label="Celular contato (WhatsApp)"
                    v-model="associado.cel"
                    :mask="maskPhone"
                    :maxlength="15"
                    optional="Envio de assinatura por WhatsApp"
                    required />

                <Input label="Nome do pai"
                    v-model="associado.nome_pai"
                    :maxlength="100" />

                <Input label="Nome da mãe"
                    v-model="associado.nome_mae"
                    :maxlength="100"
                    required />

                <Select label="Estado civil"
                    v-model="associado.estado_civil"
                    placeholder="Selecione"
                    :items="estadoCivil"
                    :valueKey="item => item.value"
                    :labelKey="item => item.label"
                    required />

                <Input label="Matrícula"
                    v-model="associado.mat"
                    :maxlength="50"
                    required />

                <Select label="Órgão"
                    v-model="associado.cod_orgao"
                    required />

                <Input label="Setor"
                    v-model="associado.setor"
                    :maxlength="50"
                    required />

                <Input label="Cargo"
                    :maxlength="50"
                    v-model="associado.cargo"
                    required />

                <Select label="Ocupação"
                    v-model="associado.ocupacao"
                    placeholder="Selecione"
                    :items="ocupacao"
                    :valueKey="item => item.value"
                    :labelKey="item => item.label"
                    required />

                <Input label="Data de admissão"
                    v-model="associado.data_admissao"
                    :mask="maskDate"
                    :maxlength="10"
                    required />
            </div>
        </CardBody>
    </Card>
</template>