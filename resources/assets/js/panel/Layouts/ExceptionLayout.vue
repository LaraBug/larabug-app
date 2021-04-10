<template>
    <div class="flex min-h-screen bg-primary-100">
        <aside class="sticky top-0 h-screen text-white w-16 bg-primary-900 flex-shrink-0 flex flex-col">
            <header class="p-4 space-y-1 border-b border-primary-800 text-center">
                <p class="text-xl font-bold">🐞</p>
            </header>

            <NavList :big="false">
                <NavListItem href="/panel" :is-active="route().current('panel.dashboard')"  :big="false">
                    <template #icon>
                        <svg
                                class="w-6 h-6 text-primary-400"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
                            ></path>
                        </svg>
                    </template>
                </NavListItem>

                <NavListItem href="/panel/projects" :is-active="route().current('panel.projects.*') || route().current('panel.exceptions.*')"  :big="false">
                    <template #icon>
                        <svg
                                class="w-6 h-6 text-primary-400"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"
                            ></path>
                        </svg>
                    </template>
                </NavListItem>

                <NavListItem href="/panel/profile" :is-active="route().current('panel.profile.*')" :big="false">
                    <template #icon>
                        <svg
                                class="w-6 h-6 text-primary-400"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                            ></path>
                        </svg>
                    </template>
                </NavListItem>
            </NavList>

            <div class="p-4 border-t justify-start gap-4 border-primary-800 grid grid-flow-col items-center text-sm mx-auto">
                <a href="https://github.com/sponsors/Cannonb4ll" class="hover:text-primary-300 flex items-center space-x-2" target="_blank">
                    <svg width="1em" height="1em" class="text-yellow-300" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                    </svg>
                </a>
            </div>
            <div class="p-4 border-t justify-start gap-4 border-primary-800 grid grid-flow-col items-center text-sm mx-auto">
                <a href="https://www.larabug.com/discord" class="hover:text-primary-300 flex items-center space-x-2" target="_blank">
                    <span>
                        D
                    </span>
                </a>
            </div>
            <footer class="p-4 border-t justify-start gap-4 border-primary-800 grid grid-flow-col items-center">
                <img :src="$page.props.auth.user.avatar" class="w-10 rounded-full bg-primary-800" />
            </footer>
        </aside>

        <main class="flex flex-col flex-1 overflow-hidden">
            <slot></slot>
        </main>
    </div>
</template>

<script>
import NavList from '@/Components/NavList'
import NavListItem from '@/Components/NavListItem'
import Container from '@/Components/Container'
import VStack from '@/Components/VStack'
import {useToast} from "vue-toastification";

export default {
    components: {
        NavList,
        NavListItem,
        Container,
        VStack,
    },

    watch: {
        '$page.props.flash' : {
            handler() {
                if (this.$page.props.flash.success) {
                    this.toast.success(this.$page.props.flash.success);
                }

                if (this.$page.props.flash.info) {
                    this.toast.info(this.$page.props.flash.info);
                }

                if ((this.$page.props.flash.error || Object.keys(this.$page.props.errors).length > 0)) {
                    if (this.$page.props.flash.error) {
                        this.toast.error(this.$page.props.flash.error);
                    }
                }
            },
            deep: true,
        }
    },

    setup() {
        const toast = useToast();
        return { toast }
    },
}
</script>
