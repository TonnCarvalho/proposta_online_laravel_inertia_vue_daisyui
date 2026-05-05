<script setup>
import { router, usePage } from '@inertiajs/vue3';
import { useColorMode } from '@vueuse/core';
import { computed } from 'vue';

const page = usePage();
const userName = page.props.auth.user.nome;
const colorMode = useColorMode()
const items = [
    {
        label: 'Proposta',
        icon: 'i-lucide-house',
        active: page.component.startsWith('proposta') ? true : false
    },
    {
        label: 'Nova Proposta',
        icon: 'i-lucide-file-plus-corner',
        badge: '4'
    },
    {
        label: 'Acompanhamento',
        icon: 'i-lucide-notepad-text',
        badge: '0',
    },
    {
        label: 'A Pagar',
        icon: 'i-lucide-badge-dollar-sign',
        badge: '0',
    },
    {
        label: 'Assinados',
        icon: 'i-lucide-file-check',
        badge: '0',
    },
    {
        label: 'CCB Enviada',
        icon: 'i-lucide-file-up',
        badge: '0',
    },
    {
        label: 'Click Sign',
        icon: 'i-lucide-file-pen',
        badge: '0',
    },
    {
        label: 'Consultas',
        icon: 'i-lucide-file-search',
        badge: '0',
    },
    {
        label: 'Estoque',
        icon: 'i-lucide-archive',
    },
    {
        label: 'Orgãos',
        icon: 'i-lucide-building',
    },
    {
        label: 'Praças',
        icon: 'i-lucide-building-2',
    },
    {
        label: 'Prestamista',
        icon: 'i-lucide-shield',
    },
    {
        label: 'Roteiros Operacionais',
        icon: 'i-lucide-book-text',
    },
    {
        label: 'Simulador de Valores',
        icon: 'i-lucide-receipt',
    },
    {
        label: 'Simulador Delfinance',
        icon: 'i-lucide-receipt',
    },
    {
        label: 'Usuários',
        icon: 'i-lucide-users',
    },
]
const userItems = computed(() => [
    [
        {
            label: 'Perfil',
            icon: 'i-lucide-user',
            to: '#'
        },
    ],
    [
        {
            label: 'Tema',
            icon: 'i-lucide-sun-moon',
            children: [
                {
                    label: 'Light',
                    icon: 'i-lucide-sun',
                    type: 'checkbox',
                    checked: colorMode.value === 'light',
                    onUpdateChecked(checked) {
                        if (checked) {
                            colorMode.value = 'light'
                        }
                    },
                    onSelect(e) {
                        e.preventDefault()
                    }
                },
                {
                    label: 'Dark',
                    icon: 'i-lucide-moon',
                    type: 'checkbox',
                    checked: colorMode.value === 'dark',
                    onUpdateChecked(checked) {
                        if (checked) {
                            colorMode.value = 'dark'
                        }
                    },
                    onSelect(e) {
                        e.preventDefault()
                    }
                }
            ]
        }
    ],
    [
        {
            label: 'Sair',
            icon: 'i-lucide-log-out',
            onSelect(e) {
                e.preventDefault()
                router.post(route('auth.destroy'))
            },
        }
    ]
])
</script>
<template>

    <UDashboardSidebar collapsible
        :default-size="17"
        :collapsed-size="0"
        :ui="{ footer: 'border-t border-default' }">

        <template #header="{ collapsed }">
            <div class="h-5 w-auto shrink-0"
                v-if="!collapsed">
                <p class="flex items-center justify-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                    <img class="w-8 h-8 mr-2"
                        src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg"
                        alt="logo">
                    SAC do Brasil
                </p>
            </div>
            <UIcon v-else
                name="i-simple-icons-nuxtdotjs"
                class="size-5 text-primary mx-auto" />
        </template>

        <template #default="{ collapsed }">
            <UNavigationMenu :collapsed="collapsed"
                :items="items"
                orientation="vertical" />
        </template>

        <template #footer>
            <UDropdownMenu :items="userItems"
                :content="{ align: 'center', collisionPadding: 12 }"
                :ui="{ content: 'w-(--reka-dropdown-menu-trigger-width) min-w-48' }">
                <UButton v-bind="userName"
                    :label="userName"
                    trailing-icon="i-lucide-chevrons-up-down"
                    color="neutral"
                    variant="ghost"
                    square
                    class="w-full data-[state=open]:bg-elevated overflow-hidden"
                    :ui="{
                        trailingIcon: 'text-dimmed ms-auto'
                    }" />
            </UDropdownMenu>
        </template>
    </UDashboardSidebar>

</template>