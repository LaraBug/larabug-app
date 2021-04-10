<template>
    <div class="flex flex-col space-y-8">
        <Breadcrumbs>
            <BreadcrumbsItem :href="route('panel.dashboard')">Dashboard</BreadcrumbsItem>
        </Breadcrumbs>

        <div class="rounded-md bg-green-50 p-4" v-if="!exceptions.length">
            <div class="flex">
                <div class="flex-shrink-0">
                    <!-- Heroicon name: check-circle -->
                    <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm leading-5 font-medium text-green-800">
                        There are no recent exceptions 🐞
                    </p>
                </div>
            </div>
        </div>


        <Card v-if="exceptions.length">
            <template #header>
                <h2 class="text-xl font-bold">Recent exceptions</h2>
            </template>

            <ul class="divide-y divide-gray-200">
                <li v-for="exception in exceptions" :key="exception.id">
                    <inertia-link :href="route('panel.exceptions.show', {id: exception.project_id, exception: exception })"
                                  class="flex items-center px-6 py-4 space-x-6 hover:bg-gray-100">
                        <div class="w-2 h-2 bg-red-600 rounded-full" v-if="exception.status === 'OPEN'"></div>
                        <div class="w-2 h-2 bg-blue-500 rounded-full" v-if="exception.status === 'READ'"></div>
                        <div class="w-2 h-2 bg-green-500 rounded-full" v-if="exception.status === 'FIXED'"></div>

                        <div class="flex-1">
                            <p class="font-medium text-bold" v-bind:class="{'text-gray-500': exception.status === 'FIXED'}">{{ exception.short_exception_text }}</p>
                            <p class="text-sm text-gray-600">
                                <Badge success v-if="exception.status === 'FIXED'">{{ exception.status_text }}</Badge>
                                <Badge info v-if="exception.status === 'READ'">{{ exception.status_text }}</Badge>
                                <Badge danger v-if="exception.status === 'OPEN'">{{ exception.status_text }}</Badge>
                                &centerdot; {{ exception.human_date }} &centerdot;
                                {{ exception.created_at }} &centerdot;
                                <Badge info v-if="exception.file_type === 'javascript'">Javascript</Badge>
                            </p>
                        </div>

                        <svg
                                class="w-6 h-6 text-gray-500"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                    fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"
                            ></path>
                        </svg>
                    </inertia-link>
                </li>
            </ul>
        </Card>
    </div>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'

import Breadcrumbs from '@/Components/Breadcrumbs'
import BreadcrumbsItem from '@/Components/BreadcrumbsItem'
import Badge from '@/Components/Badge'
import Card from '@/Components/Card'
import Button from '@/Components/Button'
import Paginator from '@/Components/Paginator'

export default {
    layout: AppLayout,
    components: {
        Breadcrumbs,
        BreadcrumbsItem,
        Badge,
        Card,
        Button,
        Paginator,
    },

    props:{
        exceptions: Object,
    }
}
</script>
