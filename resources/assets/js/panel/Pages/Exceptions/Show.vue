<template>
    <header class="flex items-center w-full h-16 px-6 bg-white border-b border-gray-200">
        <Breadcrumbs>
            <BreadcrumbsItem :href="route('panel.projects.index')">Projects</BreadcrumbsItem>
            <BreadcrumbsDivider/>
            <BreadcrumbsItem :href="route('panel.projects.show', project.id)">{{ project.title }}</BreadcrumbsItem>
            <BreadcrumbsDivider/>
            <BreadcrumbsItem href="/projects/show/exception">{{ exception.short_exception_text }}</BreadcrumbsItem>
        </Breadcrumbs>
    </header>

    <div class="flex flex-row flex-1">
        <aside class="w-1/4 h-full bg-white border-r border-gray-200">
            <dl class="px-6 py-4 space-y-4">
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

                <div>
                    <dt class="text-sm font-medium mb-1">Public</dt>
                    <dd class="grid space-y-2">
                        <div>
                            <Button v-if="!exception.publish_hash" @click="togglePublic" secondary>Share public</Button>
                        </div>
                        <div v-if="exception.publish_hash">
                            <Button as="a" :href="exception.public_route_url" :target="`exception-${exception.id}`"
                                    secondary>View
                            </Button>
                        </div>
                        <div v-if="exception.publish_hash">
                            <Button v-on:click="togglePublic" danger>
                                Remove from public
                            </Button>
                        </div>
                    </dd>
                </div>

                <div v-if="exception.status !== 'FIXED'">
                    <Button success @click="fixed">Mark as fixed</Button>
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
                            :class="[ tab === 'headers' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500']"
                            @click="tab = 'headers'"
                    >
                        Headers
                    </button>
                    <button
                            class="h-12 px-3 text-xs font-medium text-gray-500 uppercase border-b-2 border-transparent rounded-none"
                            :class="[ tab === 'server' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500']"
                            @click="tab = 'server'"
                    >
                        Server
                    </button>
                    <button
                            class="h-12 px-3 text-xs font-medium text-gray-500 uppercase border-b-2 border-transparent rounded-none"
                            :class="[ tab === 'stack-trace' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500']"
                            @click="tab = 'stack-trace'"
                    >
                        Stack trace
                    </button>
                    <button
                            class="h-12 px-3 text-xs font-medium text-gray-500 uppercase border-b-2 border-transparent rounded-none"
                            :class="[ tab === 'user' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500']"
                            @click="tab = 'user'"
                            v-if="exception.user"
                    >
                        User
                    </button>
                    <button
                            class="h-12 px-3 text-xs font-medium text-gray-500 uppercase border-b-2 border-transparent rounded-none"
                            :class="[ tab === 'feedback' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500']"
                            @click="tab = 'feedback'"
                    >
                        Feedback
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

                <div class="flex flex-col" v-if="tab === 'headers' && exception.storage && exception.storage.HEADERS">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <tbody>
                                    <tr class="bg-white" v-for="(detail, key) in exception.storage.HEADERS">
                                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                            v-text="key"></th>
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500"
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
                                        <td class="w-4/5 px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500"
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

export default {

    layout: ExceptionLayout,
    components: {
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
            tab: 'exception'
        }
    },

    mounted() {
        Prism.highlightAll();
    },

    methods: {
        togglePublic() {
            this.$inertia.post(this.route('panel.exceptions.toggle-public', [this.project.id, this.exception.id]));
        },
        fixed() {
            this.$inertia.post(this.route('panel.exceptions.fixed', [this.project.id, this.exception.id]));
        }
    }
}
</script>