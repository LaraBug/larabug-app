<template>
    <InertiaHead>
      <title>Edit {{ project.title }} Project</title>
    </InertiaHead>

    <div class="flex flex-col space-y-8">
        <Breadcrumbs>
            <BreadcrumbsItem :href="route('panel.projects.index')">Projects</BreadcrumbsItem>
            <BreadcrumbsDivider/>
            <BreadcrumbsItem :href="route('panel.projects.show', project.id)">{{ project.title }}</BreadcrumbsItem>
            <BreadcrumbsDivider/>
            <BreadcrumbsItem :href="route('panel.projects.edit', project.id)">Edit</BreadcrumbsItem>
        </Breadcrumbs>

        <Card contained>
            <template #header>
                <h2 class="text-xl font-bold">Edit project</h2>
            </template>

            <form class="space-y-6" @submit.prevent="submit">
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

                <div class="mt-4 space-y-6" :class="{'opacity-25': !form.notifications_enabled}">
                    <div class="space-y-4">
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
                    </div>

                    <div class="space-y-4">
                        <label class="text-base font-medium">Issues</label>
                        <div class="relative flex items-start">
                          <div class="flex items-center h-5">
                            <input
                                :class="[
            'text-primary-600 rounded border-gray-300 transition',
            'focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-offset-0',
          ]"
                                id="issue_receive_email"
                                type="checkbox"
                                v-model="form.issue_receive_email" />
                          </div>
                          <div class="ml-3 text-sm">
                            <label for="issue_receive_email" class="font-medium text-gray-700">Receive email notification</label>
                          </div>
                        </div>
                        <div class="relative flex items-start">
                          <div class="flex items-center h-5">
                            <input
                                :class="[
            'text-primary-600 rounded border-gray-300 transition',
            'focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-offset-0',
          ]"
                                id="issue_mobile_notifications_enabled"
                                type="checkbox"
                                v-model="form.issue_mobile_notifications_enabled" />
                          </div>
                          <div class="ml-3 text-sm">
                            <label for="issue_mobile_notifications_enabled" class="font-medium text-gray-700">Receive mobile notification</label>
                          </div>
                        </div>
                        <div class="relative flex items-start">
                          <div class="flex items-center h-5">
                            <input
                                :class="[
            'text-primary-600 rounded border-gray-300 transition',
            'focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-offset-0',
          ]"
                                id="issue_slack_webhook_enabled"
                                type="checkbox"
                                v-model="form.issue_slack_webhook_enabled" />
                          </div>
                          <div class="ml-3 text-sm">
                            <label for="issue_slack_webhook_enabled" class="font-medium text-gray-700">Call Slack Webhook</label>
                          </div>
                        </div>
                        <FormInputGroup
                            v-if="form.issue_slack_webhook_enabled"
                            v-model="form.issue_slack_webhook"
                            :error="form.errors.issue_slack_webhook"
                            label="Slack Webhook URL"
                            id="issue_slack_webhook_url"
                            required
                        />
                        <div class="relative flex items-start">
                          <div class="flex items-center h-5">
                            <input
                                :class="[
            'text-primary-600 rounded border-gray-300 transition',
            'focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-offset-0',
          ]"
                                id="issue_discord_webhook_enabled"
                                type="checkbox"
                                v-model="form.issue_discord_webhook_enabled" />
                          </div>
                          <div class="ml-3 text-sm">
                            <label for="issue_discord_webhook_enabled" class="font-medium text-gray-700">Call Discord Webhook</label>
                          </div>
                        </div>
                        <FormInputGroup
                            v-if="form.issue_discord_webhook_enabled"
                            v-model="form.issue_discord_webhook"
                            :error="form.errors.issue_discord_webhook"
                            label="Discord Webhook URL"
                            id="issue_discord_webhook_url"
                            required
                        />
                        <div class="relative flex items-start">
                          <div class="flex items-center h-5">
                            <input
                                :class="[
            'text-primary-600 rounded border-gray-300 transition',
            'focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-offset-0',
          ]"
                                id="issue_custom_webhook_enabled"
                                type="checkbox"
                                v-model="form.issue_custom_webhook_enabled" />
                          </div>
                          <div class="ml-3 text-sm">
                            <label for="issue_custom_webhook_enabled" class="font-medium text-gray-700">Call Custom Webhook</label>
                          </div>
                        </div>
                        <FormInputGroup
                            v-if="form.issue_custom_webhook_enabled"
                            v-model="form.issue_custom_webhook"
                            :error="form.errors.issue_custom_webhook"
                            label="Custom Webhook URL"
                            id="issue_custom_webhook_url"
                            required
                        />
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
                    <Button @click="submit" primary :disabled="form.processing">Update project</Button>
                    <Button as="inertia-link" :href="route('panel.projects.show', project.id)" secondary>Cancel</Button>
                    <Button @click="destroy" danger>Delete</Button>
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

    props: {
        project: Object
    },

    data() {
        return {
            sending: false,
            form: useForm ({
                title: this.project.title,
                url: this.project.url,
                description: this.project.description,
                receive_email: this.project.receive_email,
                slack_webhook: this.project.slack_webhook,
                slack_webhook_enabled: this.project.slack_webhook_enabled,
                discord_webhook: this.project.discord_webhook,
                discord_webhook_enabled: this.project.discord_webhook_enabled,
                custom_webhook: this.project.custom_webhook,
                custom_webhook_enabled: this.project.custom_webhook_enabled,
                notifications_enabled: this.project.notifications_enabled,
                mobile_notifications_enabled: this.project.mobile_notifications_enabled,
                issue_receive_email: this.project.issue_receive_email,
                issue_slack_webhook: this.project.issue_slack_webhook,
                issue_slack_webhook_enabled: this.project.issue_slack_webhook_enabled,
                issue_discord_webhook: this.project.issue_discord_webhook,
                issue_discord_webhook_enabled: this.project.issue_discord_webhook_enabled,
                issue_custom_webhook: this.project.issue_custom_webhook,
                issue_custom_webhook_enabled: this.project.issue_custom_webhook_enabled,
                issue_notifications_enabled: this.project.issue_notifications_enabled,
                issue_mobile_notifications_enabled: this.project.issue_mobile_notifications_enabled,
                telegram_notifications_enabled: this.project.telegram_notifications_enabled,
                telegram_chat_id: this.project.telegram_chat_id,
            }),
        }
    },

    methods: {
        submit() {
            this.form.put(this.route('panel.projects.update', this.project.id), {
                onStart: () => this.sending = true,
                onFinish: () => this.sending = false
            })
        },
        destroy() {
            this.form.delete(this.route('panel.projects.destroy', this.project.id),{
              onBefore: () => confirm('Are you sure you want to delete this project?'),
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
