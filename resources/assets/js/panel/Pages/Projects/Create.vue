<template>
    <InertiaHead title="Create Project" />

    <div class="flex flex-col space-y-8">
        <Breadcrumbs>
            <BreadcrumbsItem href="/panel/projects">Projects</BreadcrumbsItem>
            <BreadcrumbsDivider/>
            <BreadcrumbsItem href="/panel/projects/create">New project</BreadcrumbsItem>
        </Breadcrumbs>

        <Card contained>
            <template #header>
                <h2 class="text-xl font-bold">New project</h2>
            </template>

            <form class="space-y-6" action="">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <FormInputGroup
                        v-model="form.title"
                        :error="form.errors.title"
                        helper-text="The project's title"
                        label="Title"
                        id="title"
                        required
                    />
                    <FormInputGroup
                        v-model="form.url"
                        :error="form.errors.url"
                        label="App URL"
                        id="app_url"
                        required
                    />

                    <FormTextareaGroup v-model="form.description" label="Description" id="description"/>
                </div>

                <div class="sm:col-span-6 border-t pt-4">
                    <div class="-ml-4 -mt-2 flex items-center justify-between">
                        <div class="ml-4 mt-2">
                            <h2 class="text-xl font-medium text-blue-gray-900">Notifications</h2>
                            <p class="mt-1 text-sm text-blue-gray-500">Here you can change the notification settings for this project.</p>
                        </div>
                        <div class="ml-4 mt-2 flex-shrink-0">
                            <input
                                :class="[
        'text-primary-600 rounded border-gray-300 transition',
        'focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-offset-0',
      ]"
                                id="notifications_enabled"
                                type="checkbox"
                                v-model="form.notifications_enabled" />
                        </div>
                    </div>
                </div>

                <div class="mt-4 space-y-4" :class="{'opacity-25': !form.notifications_enabled}">
                    <label class="text-base font-medium">On new exceptions</label>
                    <div class="relative flex items-start">
                        <div class="flex items-center h-5">
                            <input
                                :class="[
        'text-primary-600 rounded border-gray-300 transition',
        'focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-offset-0',
      ]"
                                id="receive_email"
                                type="checkbox"
                                v-model="form.receive_email" />
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="receive_email" class="font-medium text-gray-700">Receive email notification</label>
                        </div>
                    </div>
                    <div class="relative flex items-start">
                        <div class="flex items-center h-5">
                            <input
                                :class="[
        'text-primary-600 rounded border-gray-300 transition',
        'focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-offset-0',
      ]"
                                id="mobile_notifications_enabled"
                                type="checkbox"
                                v-model="form.mobile_notifications_enabled" />
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="mobile_notifications_enabled" class="font-medium text-gray-700">Receive mobile notification</label>
                        </div>
                    </div>
                    <div class="relative flex items-start">
                        <div class="flex items-center h-5">
                            <input
                                :class="[
        'text-primary-600 rounded border-gray-300 transition',
        'focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-offset-0',
      ]"
                                id="slack_webhook_enabled"
                                type="checkbox"
                                v-model="form.slack_webhook_enabled" />
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="slack_webhook_enabled" class="font-medium text-gray-700">Call Slack Webhook</label>
                        </div>
                    </div>
                    <FormInputGroup
                        v-if="form.slack_webhook_enabled"
                        v-model="form.slack_webhook"
                        :error="form.errors.slack_webhook"
                        label="Slack Webhook URL"
                        id="slack_webhook_url"
                        required
                    />
                    <div class="relative flex items-start">
                        <div class="flex items-center h-5">
                            <input
                                :class="[
        'text-primary-600 rounded border-gray-300 transition',
        'focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-offset-0',
      ]"
                                id="discord_webhook_enabled"
                                type="checkbox"
                                v-model="form.discord_webhook_enabled" />
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="discord_webhook_enabled" class="font-medium text-gray-700">Call Discord Webhook</label>
                        </div>
                    </div>
                    <FormInputGroup
                        v-if="form.discord_webhook_enabled"
                        v-model="form.discord_webhook"
                        :error="form.errors.discord_webhook"
                        label="Discord Webhook URL"
                        id="discord_webhook_url"
                        required
                    />
                    <div class="relative flex items-start">
                        <div class="flex items-center h-5">
                            <input
                                :class="[
        'text-primary-600 rounded border-gray-300 transition',
        'focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-offset-0',
      ]"
                                id="custom_webhook_enabled"
                                type="checkbox"
                                v-model="form.custom_webhook_enabled" />
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="custom_webhook_enabled" class="font-medium text-gray-700">Call Custom Webhook</label>
                        </div>
                    </div>
                    <FormInputGroup
                        v-if="form.custom_webhook_enabled"
                        v-model="form.custom_webhook"
                        :error="form.errors.custom_webhook"
                        label="Custom Webhook URL"
                        id="custom_webhook_url"
                        required
                    />
                     <div class="relative flex items-start">
                        <div class="flex items-center h-5">
                            <input
                                :class="[
        'text-primary-600 rounded border-gray-300 transition',
        'focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-offset-0',
      ]"
                                id="telegram_notifications_enabled"
                                type="checkbox"
                                v-model="form.telegram_notifications_enabled" />
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="telegram_notifications_enabled" class="font-medium text-gray-700">Receive Telegram notification</label>
                        </div>
                    </div>
                    <div v-if="form.telegram_notifications_enabled">
                        <TelegramConnectingModal v-if="!form.telegram_chat_id" @chatIdUpdated="updateTelegramChatId" />

                        <template v-if="form.telegram_chat_id">
                            <div>
                              <Badge success class="w-auto">Telegram account associated</Badge>
                            </div>
                            <div class="mt-2">
                              <Button @click="telegramDissociate" type="button" primary>Dissociate telegram</Button>
                            </div>
                        </template>
                    </div>
                </div>
            </form>

            <template #footer>
                <div class="flex items-center space-x-3">
                    <Button @click="submit" primary :disabled="sending">Create project</Button>
                    <Button as="inertia-link" :href="route('panel.projects.index')" secondary>Cancel</Button>
                </div>
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
import Button from '@/Components/Button'
import Badge from '@/Components/Badge'
import FormInputGroup from '@/Components/FormInputGroup'
import FormTextareaGroup from '@/Components/FormTextareaGroup'
import TelegramConnectingModal from '@/Components/Notifications/TelegramConnectingModal'
import { useForm } from '@inertiajs/inertia-vue3'

export default {
    layout: AppLayout,
    components: {
        Breadcrumbs,
        BreadcrumbsItem,
        BreadcrumbsDivider,
        Card,
        Button,
        Badge,
        FormInputGroup,
        FormTextareaGroup,
        TelegramConnectingModal,
    },
    data() {
        return {
            sending: false,
            form: useForm ({
                title: null,
                url: null,
                description: null,
                receive_email: true,
                slack_webhook: null,
                slack_webhook_enabled: false,
                discord_webhook: null,
                discord_webhook_enabled: false,
                custom_webhook: null,
                custom_webhook_enabled: false,
                notifications_enabled: true,
                mobile_notifications_enabled: true,
                telegram_notifications_enabled: false,
                telegram_chat_id: null,
            }),
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('panel.projects.store'), {
                onStart: () => this.sending = true,
                onFinish: () => this.sending = false
            })
        },
        updateTelegramChatId(response) {
            if (! response.isSuccesseded) {
                this.telegramDissociate()
            }

            this.form.telegram_chat_id = response.id
        },
        telegramDissociate() {
            this.form.telegram_notifications_enabled = false
            this.form.telegram_chat_id = ''
        },
    },
}
</script>
