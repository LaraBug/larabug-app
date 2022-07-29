<template>
    <Modal :isOpen="isOpen" closeLink="#">
        <Card contained>
            <template #header>
                <h2 class="text-xl font-bold">Telegram Notifications</h2>
            </template>

            <div v-if="!inviteToken" class="d-flex align-items-center justify-content-center card-bg-secondary p-5 bottom-radius">
                <span>Loading...</span>
            </div>
            <div v-if="inviteToken && !chatId">
                <p>
                    You can get started by inviting <Code>@{{ botHandle }}</Code> to your Telegram chat, and issuing this command:
                </p>

                <Code class="whitespace-normal break-all">
                    {{ `/start@${botHandle} ${inviteToken}` }}
                </Code>
            </div>
            <div v-if="chatId">
                <p>
                    Your Telegram chat has been connected successfully! Please save this form.
                </p>
            </div>

            <template #footer>
                <div class="flex items-center space-x-3">
                    <Button @click="save" primary :disabled="chatId == ''">Save</Button>
                    <Button @click="cancel" secondary>Cancel</Button>
                </div>
            </template>
        </Card>
    </Modal>
</template>

<script>
import axios from "axios";
import Modal from '@/Components/Modal'
import Card from '@/Components/Card'
import Code from '@/Components/Code'
import Button from '@/Components/Button'

export default {
    components: {
        Modal,
        Card,
        Button,
        Code,
    },
    data() {
        return {
            isOpen: true,
            pooling: null,
            poolingTimes: 0,
            inviteToken: '',
            botHandle: '',
            chatId: '',
        }
    },
    methods: {
        getInviteToken() {
            axios.get(this.route('panel.projects.channels.telegram.generate-token'))
                .then(({ data }) => {
                    this.setInviteToken(data);

                    this.setChatId(data.chat_id)

                    this.checkForPollingLimit()
                })
        },
        setChatId(chatId) {
            if (chatId == '') {
                return
            }

            this.chatId = chatId
            this.stopPolling()
        },
        setInviteToken(data) {
            if (this.inviteToken != '') {
                return
            }

            this.inviteToken = data.token
            this.botHandle = data.handle
        },
        startPolling() {
            this.pooling = setInterval(() => {
                this.getInviteToken()
            }, 3000)
        },
        stopPolling() {
            if (this.pooling == null) {
                return
            }

            clearInterval(this.pooling)
        },
        checkForPollingLimit() {
            /** Limit is 120 seconds */
            if (this.pooling == null || this.poolingTimes < 30) {
                this.poolingTimes++

                return
            }

            this.stopPolling()
        },
        save() {
            this.$emit('chatIdUpdated', { id: this.chatId, isSuccesseded: true })

            this.isOpen = false
        },
        cancel() {
            this.$emit('chatIdUpdated', { id: this.chatId, isSuccesseded: false })

            this.isOpen = false
        },
    },
    mounted() {
        this.startPolling()
    },
    beforeUnmount() {
        this.stopPolling()
    },
}
</script>
