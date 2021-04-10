<template>
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
                <FormInputGroup
                        v-model="form.title"
                        :error="$page.props.errors.title"
                        helper-text="The project's title"
                        label="Title"
                        id="title"
                        required
                />
                <FormInputGroup v-model="form.url" :error="$page.props.errors.url" type="url" label="App URL" id="app_url" required/>

                <div class="grid grid-cols-2 gap-4">
                    <FormInputGroup v-model="form.slack_webhook" :error="$page.props.errors.slack_webhook" label="Slack Webhook URL" id="slack_webhook_url"/>
                    <FormInputGroup
                            v-model="form.discord_webhook"
                            :error="$page.props.errors.discord_webhook"
                            label="Discord Webhook URL"
                            id="discord_webhook_url"
                    />
                    <FormInputGroup
                            v-model="form.custom_webhook"
                            :error="$page.props.errors.custom_webhook"
                            label="Custom Webhook URL"
                            id="custom_webhook_url"
                    />
                </div>
                <FormTextareaGroup v-model="form.description" label="Description" id="description"/>

            </form>

            <template #footer>
                <div class="flex items-center space-x-3">
                    <Button @click="submit" primary>Create project</Button>
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
import FormInputGroup from '@/Components/FormInputGroup'
import FormTextareaGroup from '@/Components/FormTextareaGroup'

export default {
    layout: AppLayout,
    components: {
        Breadcrumbs,
        BreadcrumbsItem,
        BreadcrumbsDivider,
        Card,
        Button,
        FormInputGroup,
        FormTextareaGroup,
    },
    data() {
        return {
            sending: false,
            form: {
                title: null,
                url: null,
                description: null,
                receive_email: false,
                slack_webhook: null,
                discord_webhook: null,
                custom_webhook: null,
            },
        }
    },

    methods: {
        submit() {
            this.$inertia.post(this.route('panel.projects.store'), this.form, {
                onStart: () => this.sending = true,
                onFinish: () => this.sending = false
            })
        },
    },
}
</script>
