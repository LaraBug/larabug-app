<template>
	<div id="modals"></div>
	<div class="flex flex-col md:flex-row min-h-screen bg-primary-100">
		<div
			class="flex flex-col w-full md:w-72 text-white bg-primary-900 flex-shrink-0 md:h-screen md:sticky md:top-0">
			<div class="flex-shrink-0 p-4 flex flex-row items-center justify-between space-y-1">
				<p class="text-xl font-bold">LaraBug</p>
				<button class="rounded-lg md:hidden rounded-lg focus:outline-none focus:shadow-outline"
						@click="open = !open">
					<svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
						<path v-show="!open" fill-rule="evenodd"
							  d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
							  clip-rule="evenodd"></path>
						<path v-show="open" fill-rule="evenodd"
							  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
							  clip-rule="evenodd"></path>
					</svg>
				</button>
			</div>
			<NavList class="md:block" :isopen=open :is-active="route().current()">
				<NavListItem @click="open = false" href="/panel" :is-active="route().current('panel.dashboard')">
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

					Dashboard
				</NavListItem>

				<NavListItem @click="open = false" href="/panel/projects"
							 :is-active="route().current('panel.projects.*')" :isopen="open">
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

					Projects
				</NavListItem>

        <NavListItem @click="open = false" href="/panel/issues"
                     :is-active="route().current('panel.issues.*')" :isopen="open">
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

            Issues
        </NavListItem>

        <NavListItem @click="open = false" href="/panel/profile" :is-active="route().current('panel.profile.*')"
               :isopen="open">
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

          Profile
        </NavListItem>

				<NavListItem class="border-t border-primary-800" is="button" @click="logout">
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
								d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
							></path>
						</svg>
					</template>

					Logout
				</NavListItem>
			</NavList>

			<div :class="{'block': open, 'hidden': !open}"
				 class="p-4 border-t justify-start gap-4 border-primary-800 grid grid-flow-col items-center text-sm md:block">
				<a href="https://ploi.io/?ref=larabug.com"
				   class="hover:text-primary-300 flex items-center space-x-2" target="_blank">
					<svg width="1em" height="1em" class="text-white fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
						<path
							d="M424 400c0 13.255-10.745 24-24 24s-24-10.745-24-24 10.745-24 24-24 24 10.745 24 24zm-88-24c-13.255 0-24 10.745-24 24s10.745 24 24 24 24-10.745 24-24-10.745-24-24-24zm64-144c-13.255 0-24 10.745-24 24s10.745 24 24 24 24-10.745 24-24-10.745-24-24-24zm-64 0c-13.255 0-24 10.745-24 24s10.745 24 24 24 24-10.745 24-24-10.745-24-24-24zm176-72a47.758 47.758 0 0 1-6.438 24A47.758 47.758 0 0 1 512 208v96a47.758 47.758 0 0 1-6.438 24A47.758 47.758 0 0 1 512 352v96c0 26.51-21.49 48-48 48H48c-26.51 0-48-21.49-48-48v-96a47.758 47.758 0 0 1 6.438-24A47.758 47.758 0 0 1 0 304v-96a47.758 47.758 0 0 1 6.438-24A47.758 47.758 0 0 1 0 160V64c0-26.51 21.49-48 48-48h416c26.51 0 48 21.49 48 48v96zm-464 0h416V64H48v96zm416 48H48v96h416v-96zm0 144H48v96h416v-96zm-64-216c13.255 0 24-10.745 24-24s-10.745-24-24-24-24 10.745-24 24 10.745 24 24 24zm-64 0c13.255 0 24-10.745 24-24s-10.745-24-24-24-24 10.745-24 24 10.745 24 24 24z"/>
					</svg>
					<span>
                        Ploi - Server Management Tool
                    </span>
				</a>
			</div>
			<div :class="{'block': open, 'hidden': !open}"
				 class="p-4 border-t justify-start gap-4 border-primary-800 grid grid-flow-col items-center text-sm md:block">
				<a href="https://github.com/sponsors/Cannonb4ll"
				   class="hover:text-primary-300 flex items-center space-x-2" target="_blank">
					<svg width="1em" height="1em" class="text-yellow-300" viewBox="0 0 16 16" fill="currentColor"
						 xmlns="http://www.w3.org/2000/svg">
						<path
							d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
					</svg>
					<span>
                        Consider sponsoring LaraBug
                    </span>
				</a>
			</div>
			<div :class="{'block': open, 'hidden': !open}"
				 class="p-4 border-t justify-start gap-4 border-primary-800 grid grid-flow-col items-center text-sm md:block">
				<a href="https://www.larabug.com/discord" class="hover:text-primary-300 flex items-center space-x-2"
				   target="_blank">
					<svg width="1em" height="1em" viewBox="0 0 71 55" fill="none" xmlns="http://www.w3.org/2000/svg">
						<g clip-path="url(#clip0)">
							<path
								d="M60.1045 4.8978C55.5792 2.8214 50.7265 1.2916 45.6527 0.41542C45.5603 0.39851 45.468 0.440769 45.4204 0.525289C44.7963 1.6353 44.105 3.0834 43.6209 4.2216C38.1637 3.4046 32.7345 3.4046 27.3892 4.2216C26.905 3.0581 26.1886 1.6353 25.5617 0.525289C25.5141 0.443589 25.4218 0.40133 25.3294 0.41542C20.2584 1.2888 15.4057 2.8186 10.8776 4.8978C10.8384 4.9147 10.8048 4.9429 10.7825 4.9795C1.57795 18.7309 -0.943561 32.1443 0.293408 45.3914C0.299005 45.4562 0.335386 45.5182 0.385761 45.5576C6.45866 50.0174 12.3413 52.7249 18.1147 54.5195C18.2071 54.5477 18.305 54.5139 18.3638 54.4378C19.7295 52.5728 20.9469 50.6063 21.9907 48.5383C22.0523 48.4172 21.9935 48.2735 21.8676 48.2256C19.9366 47.4931 18.0979 46.6 16.3292 45.5858C16.1893 45.5041 16.1781 45.304 16.3068 45.2082C16.679 44.9293 17.0513 44.6391 17.4067 44.3461C17.471 44.2926 17.5606 44.2813 17.6362 44.3151C29.2558 49.6202 41.8354 49.6202 53.3179 44.3151C53.3935 44.2785 53.4831 44.2898 53.5502 44.3433C53.9057 44.6363 54.2779 44.9293 54.6529 45.2082C54.7816 45.304 54.7732 45.5041 54.6333 45.5858C52.8646 46.6197 51.0259 47.4931 49.0921 48.2228C48.9662 48.2707 48.9102 48.4172 48.9718 48.5383C50.038 50.6034 51.2554 52.5699 52.5959 54.435C52.6519 54.5139 52.7526 54.5477 52.845 54.5195C58.6464 52.7249 64.529 50.0174 70.6019 45.5576C70.6551 45.5182 70.6887 45.459 70.6943 45.3942C72.1747 30.0791 68.2147 16.7757 60.1968 4.9823C60.1772 4.9429 60.1437 4.9147 60.1045 4.8978ZM23.7259 37.3253C20.2276 37.3253 17.3451 34.1136 17.3451 30.1693C17.3451 26.225 20.1717 23.0133 23.7259 23.0133C27.308 23.0133 30.1626 26.2532 30.1066 30.1693C30.1066 34.1136 27.28 37.3253 23.7259 37.3253ZM47.3178 37.3253C43.8196 37.3253 40.9371 34.1136 40.9371 30.1693C40.9371 26.225 43.7636 23.0133 47.3178 23.0133C50.9 23.0133 53.7545 26.2532 53.6986 30.1693C53.6986 34.1136 50.9 37.3253 47.3178 37.3253Z"
								fill="#ffffff"/>
						</g>
						<defs>
							<clipPath id="clip0">
								<rect width="71" height="55" fill="white"/>
							</clipPath>
						</defs>
					</svg>

					<span>
                        Join our Discord server
                    </span>
				</a>
			</div>
			<footer :class="{'block': open, 'hidden': !open}"
					class="p-4 border-t justify-start gap-4 border-primary-800 grid grid-flow-col items-center md:grid">
				<img :src="$page.props.auth.user.avatar" class="w-10 h-10 rounded-full bg-primary-800"/>

				<div>
					<p class="text-base font-medium truncate">{{ $page.props.auth.user.name }}</p>
					<p class="text-sm text-primary-200">{{ $page.props.auth.user.email }}</p>
				</div>
			</footer>
		</div>
		<main class="flex-1 py-8">
			<div class="mx-auto max-w-7xl px-4 sm:px-8">
				<slot></slot>
			</div>
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
			open: false
		}
	},
	components: {
		NavList,
		NavListItem,
		Container,
		VStack,
	}
	,
	watch: {
		'$page.props.flash': {
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
	methods: {
		logout() {
			if (window.confirm('Are you sure you want to logout?')) {
				this.$inertia.post(this.route('logout'));
			}
		}
	},
	setup() {
		const toast = useToast();
		return {toast}
	},
}
</script>
