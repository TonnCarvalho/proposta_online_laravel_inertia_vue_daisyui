<script setup lang="ts">
import { h, resolveComponent, ref } from 'vue'
import type { TableColumn } from '@nuxt/ui'
import type { Row } from '@tanstack/vue-table'
import { useClipboard } from '@vueuse/core'

const UButton = resolveComponent('UButton')
const UBadge = resolveComponent('UBadge')
const UDropdownMenu = resolveComponent('UDropdownMenu')

const toast = useToast()
const { copy } = useClipboard()

interface Associado {
  id: number,
  nome: string,
}
interface Origem {
  id: number,
  nome: string,
}
interface Proposta {
  id: number,
  num_proposta: number,
  status_proposta: number,
  created_at: string,
  associado: Associado,
  origem: Origem,
}

const props = defineProps<{
  propostas: Proposta[]
}>()

const columns: TableColumn<Proposta>[] = [
  {
    accessorKey: 'num_proposta',
    header: 'Proposta',
  },
  {
    accessorKey: 'associado.nome',
    header: 'Associado',
  },
  {
    accessorKey: 'origem.nome',
    header: 'Praça',
  },
  {
    accessorKey: 'status',
    header: 'Status',
    cell: ({ row }) => {
      const color = {
        paid: 'success' as const,
        failed: 'error' as const,
        refunded: 'neutral' as const
      }[row.getValue('status') as string]

      return h(UBadge, { class: 'capitalize', variant: 'subtle', color }, () =>
        row.getValue('status')
      )
    }
  },
  {
    accessorKey: 'created_at',
    header: 'Date',
    cell: ({ row }) => {
      return new Date(row.getValue('created_at')).toLocaleString('pt-BR', {
        day: 'numeric',
        month: 'numeric',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        hour12: false
      })
    }
  },
  {
    id: 'actions',
    header: 'Opções',
    meta: {
      class: {
        td: 'text-right'
      }
    },
    cell: ({ row }) => {
      return h(
        UDropdownMenu,
        {
          content: {
            align: 'end'
          },
          items: getRowItems(row),
          'aria-label': 'Actions dropdown'
        },
        () =>
          h(UButton, {
            icon: 'i-lucide-ellipsis-vertical',
            color: 'neutral',
            variant: 'ghost',
            'aria-label': 'Actions dropdown'
          })
      )
    }
  }
]

function getRowItems(row: Row<Proposta>) {
  return [
    {
      label: 'Copy payment ID',
      onSelect() {
        copy(row.original.proposta)

        toast.add({
          title: 'Payment ID copied to clipboard!',
          color: 'success',
          icon: 'i-lucide-circle-check'
        })
      }
    },
    {
      type: 'separator'
    },
    {
      label: 'View customer'
    },
    {
      label: 'View payment details'
    }
  ]
}
</script>

<template>


  <UCard class="mt-5">
    <template #header>
      <div class="flex items-center gap-3">
        <UIcon name="i-lucide-file-text"
          class="text-primary" />
        <strong>
          Suas Propostas
        </strong>
      </div>
    </template>
    <UTable :data="propostas"
      :columns="columns"
      class="flex-1" />
  </UCard>

</template>
