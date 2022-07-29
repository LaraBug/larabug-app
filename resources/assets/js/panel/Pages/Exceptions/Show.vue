<template>
    <InertiaHead>
      <title>Exception for {{ project.title }} Project</title>
    </InertiaHead>

    <header class="flex items-center w-full h-16 px-6 bg-white border-b border-gray-200">
        <Breadcrumbs>
            <BreadcrumbsItem :href="route('panel.projects.index')">Projects</BreadcrumbsItem>
            <BreadcrumbsDivider/>
            <BreadcrumbsItem :href="route('panel.projects.show', project.id)">{{ project.title }}</BreadcrumbsItem>
            <BreadcrumbsDivider/>
            <BreadcrumbsItem :href="exception.route_url" class="whitespace-nowrap sm:whitespace-normal">
                {{ exception.short_exception_text }}
            </BreadcrumbsItem>
        </Breadcrumbs>
    </header>

    <div class="flex w-full bg-white px-6 py-3 border-b border-gray-200 space-x-3">
        <Button v-if="exception.status !== 'FIXED'" success @click="fixed">Mark as fixed</Button>



        <Button v-if="!exception.publish_hash" @click="togglePublic" secondary>Share public</Button>

        <Button v-if="exception.publish_hash" @click="togglePublic" danger>Remove from public</Button>

        <Button v-if="exception.publish_hash" as="a" :href="exception.public_route_url" :target="`exception-${exception.id}`" secondary>View public</Button>

        <Button v-if="exception.issue_id" as="a" :href="exception.issue_route_url" :target="`issue-${exception.issue_id}`" secondary>View issue</Button>

        <Dropdown v-if="!exception.snooze_until">
            <template v-slot:button>
                <Button primary>
                    Snooze
                </Button>
            </template>

            <template v-slot:options>
                <DropdownOption @click="snooze(minutes)" v-for="(option, minutes) in snoozeOptions" :key="minutes">
                    {{ option }}
                </DropdownOption>
            </template>
        </Dropdown>

        <div v-if="exception.snooze_until" class="space-x-3">
            <Button secondary @click="unSnooze">Unsnooze</Button>
            <span>Snoozed until {{ exception.snooze_until }}</span>
        </div>
		
        <Button @click="throwInTrash" danger>Delete</Button>
    </div>

    <div class="flex flex-col sm:flex-row flex-1">
        <aside class="w-full sm:w-1/4 sm:h-full bg-white border-r border-gray-200">
            <dl class="px-6 py-4 space-y-4">
                <div v-if="exception.environment">
                    <dt class="text-sm font-medium">Environment</dt>
                    <dd>
                        <Code>{{ exception.environment }}</Code>
                    </dd>
                </div>

                <div v-if="exception.project_version">
                    <dt class="text-sm font-medium">Project version</dt>
                    <dd>
                        <Code>{{ exception.project_version }}</Code>
                    </dd>
                </div>

                <div>
                    <dt class="text-sm font-medium">Method</dt>
                    <dd>
                        <Code>{{ exception.method }}</Code>
                    </dd>
                </div>

                <div>
                    <dt class="text-sm font-medium">URL</dt>
                    <dd>
                        <Code>{{ exception.fullUrl }}</Code>
                    </dd>
                </div>

                <div>
                    <dt class="text-sm font-medium">File</dt>
                    <dd>
                        <Code>{{ exception.file }}</Code>
                    </dd>
                </div>

                <div>
                    <dt class="text-sm font-medium">Class</dt>
                    <dd>
                        <Code>{{ exception.class }}</Code>
                    </dd>
                </div>

                <div>
                    <dt class="text-sm font-medium">Line</dt>
                    <dd>
                        <Code>{{ exception.line }}</Code>
                    </dd>
                </div>

                <div>
                    <dt class="text-sm font-medium">Reported</dt>
                    <dd>
                        <Code>{{ exception.created_at }}</Code>
                    </dd>
                </div>
            </dl>
        </aside>

        <div class="flex flex-1 flex-col divide-y divide-gray-200 overflow-hidden">
            <div class="p-6 bg-white">
                <p>
                    <span class="text-sm font-medium">Exception</span>

                    &centerdot;

                    <Badge success v-if="exception.status === 'FIXED'">{{ exception.status_text }}</Badge>
                    <Badge info v-if="exception.status === 'READ'">{{ exception.status_text }}</Badge>
                    <Badge danger v-if="exception.status === 'OPEN'">{{ exception.status_text }}</Badge>
                </p>
                <p class="text-xl">{{ exception.exception }}</p>
            </div>

            <div class="bg-white">
                <header class="flex items-center px-3">
                    <button
                        class="h-12 px-3 text-xs font-medium uppercase border-b-2 rounded-none"
                        :class="[ tab === 'exception' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500']"
                        @click="tab = 'exception'"
                    >
                        Exception
                    </button>
                    <button
                        class="h-12 px-3 text-xs font-medium text-gray-500 uppercase border-b-2 border-transparent rounded-none"
                        :class="[ tab === 'request' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500']"
                        @click="tab = 'request'"
                    >
                        Request
                    </button>
                    <button
                        class="h-12 px-3 text-xs font-medium text-gray-500 uppercase border-b-2 rounded-none"
                        :class="[ tab === 'server' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500']"
                        @click="tab = 'server'"
                    >
                        Server
                    </button>
                    <button
                        class="h-12 px-3 text-xs font-medium text-gray-500 uppercase border-b-2 rounded-none"
                        :class="[ tab === 'stack-trace' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500']"
                        @click="tab = 'stack-trace'"
                    >
                        Stack trace
                    </button>
                    <button
                        class="h-12 px-3 text-xs font-medium text-gray-500 uppercase border-b-2 rounded-none"
                        :class="[ tab === 'user' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500']"
                        @click="tab = 'user'"
                        v-if="exception.user"
                    >
                        User
                    </button>
                </header>
            </div>

            <div class="p-6">
                <div v-show="tab === 'exception'">
                    <pre class="line-numbers"
                         v-if="exception.executor && exception.executor[0] && exception.executor[0].line_number"
                         v-bind:class="[exception.markup_language]"
                         :data-start="exception.executor[0].line_number"
                         :data-line="exception.line"><code v-text="exception.executor_output"></code></pre>
                </div>

                <div class="flex flex-col"
                     v-if="tab === 'request' && exception.storage && (exception.storage.PARAMETERS || exception.storage.HEADERS)">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
                             v-if="exception.storage.PARAMETERS">
                            <h3 class="mb-3">Parameters</h3>
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <tbody>
                                    <tr class="bg-white" v-for="(detail, key) in exception.storage.PARAMETERS">
                                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                            v-text="key"></th>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm leading-5 text-gray-500"
                                            v-text="detail"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
                             v-if="exception.storage.HEADERS">
                            <h3 class="mb-3">Headers</h3>
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <tbody>
                                    <tr class="bg-white" v-for="(detail, key) in exception.storage.HEADERS">
                                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                            v-text="key"></th>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm leading-5 text-gray-500"
                                            v-text="detail[0]"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col" v-if="tab === 'server' && exception.storage && exception.storage.SERVER">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <tbody>
                                    <tr class="bg-white" v-for="(detail, key) in exception.storage.SERVER">
                                        <th class="w-1/5 px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                            v-text="key"></th>
                                        <td class="w-4/5 px-6 py-4 whitespace-nowrap text-sm leading-5 text-gray-500"
                                            v-text="detail"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div v-show="tab === 'stack-trace'">
                    <pre class="language-sh line-numbers"><code v-html="exception.error"></code></pre>
                </div>

                <div v-show="tab === 'user'" v-if="exception.user">
                    <div class="bg-white rounded shadow px-6 py-4 mt-2">
                        <table class="w-full">
                            <tr class="" v-for="(detail, key) in exception.user">
                                <th class="px-1 pt-3 pb-2 text-left font-bold" v-text="key"></th>
                                <td v-text="detail"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ExceptionLayout from '@/Layouts/ExceptionLayout'

import Breadcrumbs from '@/Components/Breadcrumbs'
import BreadcrumbsItem from '@/Components/BreadcrumbsItem'
import BreadcrumbsDivider from '@/Components/BreadcrumbsDivider'
import Card from '@/Components/Card'
import Badge from '@/Components/Badge'
import Button from '@/Components/Button'
import ButtonRack from '@/Components/ButtonRack'
import ButtonRackItem from '@/Components/ButtonRackItem'
import Code from '@/Components/Code'
import Prism from '../../../plugins/prism';
import Dropdown from "../../Components/Dropdown";
import DropdownOption from "../../Components/DropdownOption";

export default {

    layout: ExceptionLayout,
    components: {
      DropdownOption,
      Dropdown,
        Breadcrumbs,
        BreadcrumbsItem,
        BreadcrumbsDivider,
        Card,
        Button,
        ButtonRack,
        ButtonRackItem,
        Badge,
        Code,
    },

    props: {
        project: Object,
        exception: Object,
    },

    data() {
        return {
            tab: 'exception',

            snoozeTime: 30,

            snoozeOptions: {
                30: '30 minutes',
                60: '1 hour',
                120: '2 hours',
                180: '3 hours',
                240: '4 hours',
                300: '5 hours',
                360: '6 hours',
                720: '12 hours',
                1440: '24 hours',
                10080: 'A week',
                43800: 'A month',
                5256000: 'Forever (10 years)',
            },
        }
    },

    mounted() {
        Prism.highlightAll();
    },

    methods: {
        fixed() {
            this.$inertia.post(this.route('panel.exceptions.fixed', [this.project.id, this.exception.id]));
        },
        snooze(minutes) {
            this.$inertia.post(this.route('panel.exceptions.snooze', [this.project.id, this.exception.id]), {
                snooze: minutes
            });
        },
        throwInTrash() {
            this.$inertia.delete(this.route('panel.exceptions.show', [this.project.id, this.exception.id]));
        },
        togglePublic() {
            this.$inertia.post(this.route('panel.exceptions.toggle-public', [this.project.id, this.exception.id]));
        },
        unSnooze() {
            this.$inertia.post(this.route('panel.exceptions.un-snooze', [this.project.id, this.exception.id]));
        },
    }
}
</script>
