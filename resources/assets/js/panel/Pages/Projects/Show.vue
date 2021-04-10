<template>
    <div class="flex flex-col space-y-8">
        <Breadcrumbs>
            <BreadcrumbsItem :href="route('panel.projects.index')">Projects</BreadcrumbsItem>
            <BreadcrumbsDivider/>
            <BreadcrumbsItem :href="route('panel.projects.show', project.id)">{{ project.title }}</BreadcrumbsItem>
        </Breadcrumbs>

        <Card>
            <template #header>
                <h2 class="text-xl font-bold">Project</h2>

                <ButtonRack>
                    <ButtonRackItem as="inertia-link" :href="route('panel.projects.installation', project.id)">
                        Installation guide
                    </ButtonRackItem>
                    <ButtonRackItem as="inertia-link" :href="route('panel.projects.edit', project.id)">Edit project
                    </ButtonRackItem>
                </ButtonRack>
            </template>

            <dl class="grid grid-cols-3 gap-px overflow-hidden bg-gray-100 rounded-b-lg">
                <div class="p-6 space-y-1 bg-white">
                    <dt class="text-sm font-medium">Title</dt>
                    <dd class="text-base">{{ project.title }}</dd>
                </div>

                <div class="p-6 space-y-1 bg-white">
                    <dt class="text-sm font-medium">Application URL</dt>
                    <dd class="text-base">
                        <a :href="project.url" v-text="project.url"></a>
                    </dd>
                </div>

                <div class="p-6 space-y-1 bg-white">
                    <dt class="text-sm font-medium">API Key</dt>
                    <dd class="text-sm">
                        <Code>{{ project.key }}</Code>
                    </dd>
                </div>

                <div class="p-6 space-y-1 bg-white">
                    <dt class="text-sm font-medium">New exceptions</dt>
                    <dd class="text-base">{{ project.unread_exceptions_count }}</dd>
                </div>

                <div class="p-6 space-y-1 bg-white">
                    <dt class="text-sm font-medium">Total exceptions</dt>
                    <dd class="text-base">{{ project.total_exceptions }}</dd>
                </div>

                <div class="p-6 space-y-1 bg-white">
                    <dt class="text-sm font-medium">Description</dt>
                    <dd class="text-base">{{ project.description }}</dd>
                </div>
            </dl>
        </Card>

        <Card>
            <template #header>
                <h2 class="text-xl font-bold">Exceptions</h2>

                <ButtonRack>
                    <ButtonRackItem @click="handleMarking('read')">Mark {{ selected.length ? 'selected' : 'all' }} read</ButtonRackItem>
                    <ButtonRackItem @click="handleMarking('fixed')">Mark {{ selected.length ? 'selected' : 'all' }} fixed
                    </ButtonRackItem>
                    <ButtonRackItem @click="deleteAllExceptions">Delete all</ButtonRackItem>
                </ButtonRack>
            </template>

            <header class="flex items-center px-6 py-4 space-x-4 bg-primary-50">
                <input
                        placeholder="Search exceptions..."
                        class="flex-1 rounded-lg shadow-sm form-input"
                        type="text"
                        v-model="form.search"
                />
            </header>

            <ul class="divide-y divide-gray-200">
                <li v-for="exception in exceptions.data" :key="exception.id">
                    <div :href="route('panel.exceptions.show', {id: project.id, exception: exception })"
                         class="flex items-center px-6 py-4 space-x-6 hover:bg-gray-100">
                        <div class="flex items-center space-x-2">
                            <input
                                    :class="[
        'form-checkbox text-primary-600',
        'transition duration-150 ease-in-out',
        'focus:outline-none focus:shadow-focus',
      ]"
                                    id="newsletter"
                                    type="checkbox"
                                    :value="exception.id"
                                    v-model="selected"
                            />
                        </div>

                        <inertia-link class="flex flex-1 items-center" :href="route('panel.exceptions.show', {id: project.id, exception: exception })">
                            <div class="flex-1">
                                <p class="font-medium text-bold"
                                   v-bind:class="{'text-gray-500': exception.status === 'FIXED'}">
                                    {{ exception.short_exception_text }}</p>
                                <p class="text-sm text-gray-600">
                                    <Badge success v-if="exception.status === 'FIXED'">{{ exception.status_text }}</Badge>
                                    <Badge info v-if="exception.status === 'READ'">{{ exception.status_text }}</Badge>
                                    <Badge danger v-if="exception.status === 'OPEN'">{{ exception.status_text }}</Badge>
                                    &centerdot; {{ exception.human_date }} &centerdot;
                                    {{ exception.created_at }}
                                    <Badge info v-if="exception.file_type === 'javascript'">&centerdot; Javascript</Badge>
                                </p>
                            </div>
                            <div class="flex-1"></div>

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
                    </div>
                </li>
            </ul>

            <template #footer>
                <Paginator :paginated="exceptions"/>
            </template>
        </Card>
    </div>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'

import Breadcrumbs from '@/Components/Breadcrumbs'
import BreadcrumbsItem from '@/Components/BreadcrumbsItem'
import BreadcrumbsDivider from '@/Components/BreadcrumbsDivider'
import Card from '@/Components/Card'
import Badge from '@/Components/Badge'
import Button from '@/Components/Button'
import ButtonRack from '@/Components/ButtonRack'
import ButtonRackItem from '@/Components/ButtonRackItem'
import Code from '@/Components/Code'
import Paginator from '@/Components/Paginator'
import EditProject from '@/Partials/EditProject'
import throttle from 'lodash/throttle'
import pickBy from 'lodash/pickBy'
import mapValues from 'lodash/mapValues'

export default {
    layout: AppLayout,
    components: {
        EditProject,
        Breadcrumbs,
        BreadcrumbsItem,
        BreadcrumbsDivider,
        Code,
        Card,
        Button,
        ButtonRack,
        ButtonRackItem,
        Paginator,
        Badge,
    },
    props: {
        project: Object,
        exceptions: Object,
        filters: Object,
    },
    data() {
        return {
            sending: false,

            selected: [],

            form: {
                project: this.project.id,
                search: this.filters.search,
                status: this.filters.status,
                has_feedback: this.filters.has_feedback
            },
        }
    },
    watch: {
        form: {
            handler: throttle(function () {
                let query = pickBy(this.form)
                this.$inertia.replace(this.route('panel.projects.show', Object.keys(query).length ? query : {remember: 'forget'}))
            }, 500),
            deep: true,
        },
    },
    methods: {
        handleMarking(type) {
            if(this.selected.length){
                this.markSelectedAs(type);

                return;
            }

            if(type === 'read'){
                this.read();
            }

            if(type === 'fixed'){
                this.fixed();
            }
        },

        reset() {
            this.form = mapValues(this.form, (item, key) => {
                // We have to remember the project key, because the route parameter requires this
                if (key == 'project') {
                    return item;
                }

                return null;
            })
        },

        fixed() {
            this.sending = true;

            this.$inertia.post(this.route('panel.exceptions.mark-all-fixed', this.project.id))
                .then(() => {
                    this.sending = false;
                })
                .catch(() => {
                    this.sending = false;
                })
        },

        read() {
            this.$inertia.post(this.route('panel.exceptions.mark-all-read', this.project.id), {
                onStart: () => this.sending = true,
                onFinish: () => this.sending = false
            });
        },

        deleteAllExceptions() {
            this.sending = true;

            this.$inertia.delete(this.route('panel.exceptions.delete-all', this.project.id))
                .then(() => {
                    this.sending = false;
                })
                .catch(() => {
                    this.sending = false;
                })
        },

        markSelectedAs(type) {
            this.$inertia.post(this.route('panel.exceptions.mark-as', this.project.id), {
                exceptions: this.selected,
                type: type.toUpperCase()
            }, {
                onSuccess: () => {
                    this.selected = [];
                }
            })
        }
    }
}
</script>
