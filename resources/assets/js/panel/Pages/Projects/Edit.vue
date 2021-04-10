<template>
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
                <FormInputGroup
                        v-model="form.title"
                        :error="$page.props.errors.title"
                        helper-text="The project's title"
                        label="Title"
                        id="title"
                        required
                />
                <FormInputGroup v-model="form.url" label="App URL" id="app_url" required/>

                <div class="grid grid-cols-2 gap-4">
                    <FormInputGroup v-model="form.slack_webhook" label="Slack Webhook URL" id="slack_webhook_url"
                                    required/>
                    <FormInputGroup
                            v-model="form.discord_webhook"
                            label="Discord Webhook URL"
                            id="discord_webhook_url"
                            required
                    />

                    <div class="flex items-center space-x-2">
                        <input
                                :class="[
        'form-checkbox text-primary-600',
        'transition duration-150 ease-in-out',
        'focus:outline-none focus:shadow-focus',
      ]"
                                id="receive_email"
                                type="checkbox"
                                v-model="form.receive_email"
                        />

                        <label class="text-sm font-medium" for="receive_email">
                            Receive email on new exceptions
                        </label>
                    </div>
                </div>

                <FormTextareaGroup v-model="form.description" label="Description" id="description"/>
            </form>

            <template #footer>
                <div class="flex items-center space-x-3">
                    <Button @click="submit" primary>Update project</Button>
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

    props: {
        project: Object
    },

    data() {
        return {
            sending: false,
            form: {
                title: this.project.title,
                url: this.project.url,
                description: this.project.description,
                receive_email: this.project.receive_email,
                slack_webhook: this.project.slack_webhook,
                discord_webhook: this.project.discord_webhook,
            },
        }
    },

    methods: {
        submit() {
            this.$inertia.put(this.route('panel.projects.update', this.project.id), this.form, {
                onStart: () => this.sending = true,
                onFinish: () => this.sending = false
            })
        },
        destroy() {
            if (confirm('Are you sure you want to delete this project?')) {
                this.$inertia.delete(this.route('panel.projects.destroy', this.project.id))
            }
        },
    },
}
</script>
