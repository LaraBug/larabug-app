<template>
    <div>
        <heading class="mb-6">Newsletter</heading>

        <div class="card relative">
            <div class="overflow-hidden overflow-x-auto relative p-4">
                <p class="mb-4 text-gray-600">
                    Current reach: {{ total }}
                </p>

                <div class="border-b border-40 mb-4 pb-2">
                    <div class="flex items-center mb-2">
                        <input id="test" v-model="filters.test" type="checkbox"
                               class="form-checkbox border-gray-400 h-4 w-4 text-indigo-600"/>
                        <label for="test" class="ml-3 font-medium text-gray-700">
                            Send as test to my e-mail address
                        </label>
                    </div>

                    <div class="flex items-center mb-2">
                        <input id="newsletter_preference" :disabled="filters.test" v-model="filters.newsletter_preference" type="checkbox"
                               class="form-checkbox border-gray-400 h-4 w-4 text-indigo-600"/>
                        <label for="newsletter_preference" class="ml-3 font-medium text-gray-700" v-bind:class="{ 'line-through' : filters.test }">
                            User must have newsletter preference on
                        </label>
                    </div>


                    <div class="flex items-center mb-2">
                        <input id="trialUser" v-model="filters.trial_users" :disabled="filters.test" type="checkbox"
                               class="form-checkbox border-gray-400 h-4 w-4 text-indigo-600"/>
                        <label for="trialUser" class="ml-3 font-medium text-gray-700"
                               v-bind:class="{ 'line-through' : filters.test }">Only trial users</label>
                    </div>

                    <div class="flex">
                        <div class="w-1/5 px-1 py-2">
                            <label for="usersPlan" class="inline-block text-gray-700 pt-2 leading-tight">
                                Users on plan
                            </label>
                        </div>
                        <div class="py-1 px-2 w-1/2">
                            <select id="usersPlan" :disabled="filters.test" v-model="filters.user_plan" class="w-full form-control form-input form-input-bordered" placeholder="Select a server type to filter on">
                                <option value="">Select a plan to filter on</option>
                                <option value="1">Starter</option>
                                <option value="2">Unlimited</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex">
                        <div class="w-1/5 px-1 py-2">
                            <label for="userAge" class="inline-block text-gray-700 pt-2 leading-tight">
                                User age in months
                            </label>
                        </div>
                        <div class="py-1 px-2 w-1/2">
                            <input id="userAge" type="number" :disabled="filters.test" step="1" min="0" v-model="filters.user_age"
                                   placeholder="Enter a age in months"
                                   class="w-full form-control form-input form-input-bordered">
                        </div>
                    </div>
                </div>

                <div class="flex">
                    <div class="w-1/5 px-2 py-1">
                        <label for="subject" class="inline-block text-80 pt-2 leading-tight">
                            Subject
                        </label>
                    </div>
                    <div class="py-1 px-2 w-1/2">
                        <input id="subject" :disabled="loading" v-model="subject" type="text" placeholder="Enter a subject for the newsletter"
                               class="w-full form-control form-input form-input-bordered" v-bind:class="{ 'border-danger' : errors.subject }">

                        <p v-if="errors.subject" class="my-2 text-danger">
                            {{ errors.subject[0] }}
                        </p>
                    </div>
                </div>
                <div class="flex">
                    <div class="w-1/5 px-2 py-1">
                        <label for="content" class="inline-block text-80 pt-2 leading-tight">
                            Content
                        </label>
                    </div>
                    <div class="py-1 px-2 w-4/5">
                        <vue-simplemde id="content" v-model="content" ref="markdownEditor" :configs="{ placeholder: 'Say hi to some awesome people 👋' }" />

                        <p v-if="errors.content" class="my-2 text-danger">
                            {{ errors.content[0] }}
                        </p>
                    </div>
                </div>

                <div class="flex">
                    <div class="py-1 px-2 w-full">
                        <button :disabled="!total || loading" type="submit"
                                v-on:click="send"
                                class="btn btn-default btn-primary float-right"
                                v-text="sendButtonText">
                        </button>

                        <button :disabled="!total || loading" type="submit"
                                v-on:click="reset"
                                class="btn btn-default btn-primary float-right  mr-2"
                                v-text="`Reset`">
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                loading: false,
                subject: '',
                content: '',
                total: 0,
                filters: {
                    server_type: '',
                    test: true,
                    newsletter_preference: true,
                    active_server: false,
                    trial_users: false,
                    user_age: 0,
                    user_plan: '',
                },
                errors:[]
            }
        },

        watch: {
            filters: {
                // This will let Vue know to look inside the array
                deep: true,

                // We have to move our method to a handler field
                handler() {
                    this.refreshPage();
                }
            }
        },

        computed: {
            parameters() {
                return Object.keys(this.filters).map(key => `${key}=${encodeURIComponent(this.filters[key])}`).join('&');
            },
            sendButtonText() {
                if (!this.total) {
                    return 'No results to send to..'
                }

                return 'Send newsletter'
            }
        },

        mounted() {
            this.refreshPage();
        },

        methods: {
            refreshPage() {
                this.loading = true;

                Nova.request().get(`/nova-vendor/nova-newsletter/reach?${this.parameters}`)
                    .then((response) => {
                        this.loading = false;
                        this.total = response.data.total;
                    });
            },

            send() {
                this.loading = true;
                this.errors = [];

                Nova.request().post(`/nova-vendor/nova-newsletter/send?${this.parameters}`, {
                    subject: this.subject,
                    content: this.content
                })
                    .then((response) => {
                        this.$toasted.show(response.data, {type: 'success'})
                        this.loading = false;
                    })
                .catch(error => {
                    this.loading = false;
                    this.errors = error.response.data.errors;
                })
            },

            reset() {
                this.content = '';
                this.subject = '';
            }
        },
    }
</script>