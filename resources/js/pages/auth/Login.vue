<script setup>
import Input from '@/components/form/Input.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    cod_corretor: '',
    password: '',
    remember: '',
})
const submit = () => {
    form.post(route('auth.store'), {
        onFinish: () => form.reset('password')
    })
}
</script>

<template>
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">

            <div
                class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <a href="#"
                        class="flex items-center justify-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                        <img class="w-8 h-8 mr-2"
                            src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg"
                            alt="logo">
                        Empresa
                    </a>
                    <form class="space-y-4 md:space-y-6"
                        @submit.prevent="submit">

                        <Input label="Código"
                            name="cod_corretor"
                            placeholder="1000"
                            v-model="form.cod_corretor"
                            :icon="['far', 'user']"
                            :error="$page.props.errors.cod_corretor" />

                        <Input label="Senha"
                            name="password"
                            v-model="form.password"
                            placeholder="••••••••"
                            :icon="['fas', 'lock']" />

                        <button type="submit"
                            class="text-white bg-brand hover:bg-brand-strong box-border border border-transparent focus:ring-4 w-full focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
                            <font-awesome-icon icon="arrow-right-to-bracket"
                                class="text-white" />
                            Entrar
                        </button>

                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Quer ser um corretor ou um associado?
                            <a href="#"
                                class="font-medium text-primary-600 hover:underline dark:text-primary-500">
                                Fale conosco
                            </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>
