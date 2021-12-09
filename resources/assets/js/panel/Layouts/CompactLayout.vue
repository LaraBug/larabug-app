<template>
    <div class="flex flex-col md:flex-row min-h-screen bg-primary-100">
      <div class="flex flex-col w-full md:w-16 text-white bg-primary-900 flex-shrink-0">
        <div class="flex-shrink-0 p-4 flex flex-row items-center justify-between md:justify-center">
          <p class="text-xl font-bold">🐞</p>
          <button class="rounded-lg md:hidden rounded-lg focus:outline-none focus:shadow-outline" @click="open = !open">
            <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
              <path v-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
              <path v-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
          </button>
        </div>
        <NavList class="md:block" :isopen=open :is-active="route().current()">
          <NavListItem @click="open = false" href="/panel" :is-active="route().current('panel.dashboard')" :big="false">
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
            <span class="md:hidden">Dashboard</span>
          </NavListItem>

          <NavListItem @click="open = false" href="/panel/projects" :is-active="route().current('panel.projects.*')" :big="false">
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

            <span class="md:hidden">Projects</span>
          </NavListItem>

          <NavListItem @click="open = false" href="/panel/issues" :is-active="route().current('panel.issues.*')" :big="false">
            <template #icon>
              <svg
                  class="w-6 h-6 text-primary-400"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg"
              >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
              </svg>
            </template>

            <span class="md:hidden">Issues</span>
          </NavListItem>

          <NavListItem @click="open = false" href="/panel/profile" :is-active="route().current('panel.profile.*')" :big="false">
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

            <span class="md:hidden">Profile</span>
          </NavListItem>
        </NavList>
        <div :class="{'block': open, 'hidden': !open}" class="p-4 border-t justify-start gap-4 border-primary-800 grid grid-flow-col items-center text-sm md:block md:mx-auto">
          <a href="https://github.com/sponsors/Cannonb4ll" class="hover:text-primary-300 flex items-center space-x-2" target="_blank">
            <svg width="1em" height="1em" class="text-yellow-300" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
            </svg>
            <span class="md:hidden">
                        Consider sponsoring LaraBug
                    </span>
          </a>
        </div>
        <div :class="{'block': open, 'hidden': !open}" class="p-4 border-t justify-start gap-4 border-primary-800 grid grid-flow-col items-center text-sm md:block md:mx-auto">
          <a href="https://www.larabug.com/discord" class="md:hidden hover:text-primary-300 flex items-center space-x-2" target="_blank">
            <span>Join our Discord server</span>
          </a>
          <a href="https://www.larabug.com/discord" class="hover:text-primary-300 flex items-center space-x-2 hidden md:block" target="_blank">
            <span>D</span>
          </a>
        </div>
        <footer :class="{'block': open, 'hidden': !open}" class="p-4 border-t justify-start gap-4 border-primary-800 grid grid-flow-col items-center md:block">
          <img :src="$page.props.auth.user.avatar" class="w-10 rounded-full bg-primary-800" />
          <div class="md:hidden">
            <p class="text-base font-medium truncate">{{ $page.props.auth.user.name }}</p>
            <p class="text-sm text-primary-200">{{ $page.props.auth.user.email }}</p>
          </div>
        </footer>
      </div>
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
  data() {
    return {
      open:false
    }
  },
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
