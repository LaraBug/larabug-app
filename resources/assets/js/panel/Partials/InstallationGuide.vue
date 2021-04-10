<template>
    <Modal :is-open="hasGuide" close-link="/projects/show">
        <Card>
            <template #header>
                <h2 class="text-xl font-bold">Installation guide</h2>
            </template>

            <div>
                <header class="sticky top-0 z-10 flex items-center bg-white border-b border-gray-200">
                    <button
                            class="inline-flex items-center justify-center h-12 px-6 text-sm font-medium"
                            @click="step = 1"
                    >
                        Installation
                    </button>
                    <button
                            class="inline-flex items-center justify-center h-12 px-6 text-sm font-medium"
                            @click="step = 2"
                    >
                        Usage
                    </button>
                </header>

                <div class="relative p-6 overflow-hidden">
                    <TransitionGroup
                            mode="out-in"
                            enter-from-class="-translate-x-6 opacity-0"
                            enter-active-class="transition duration-300 ease-in-out transform"
                            enter-to-class="translate-x-0 opacity-100"
                            leave-from-class="translate-x-0 opacity-100"
                            leave-active-class="absolute transition duration-300 ease-in-out transform"
                            leave-to-class="translate-x-6 opacity-0"
                    >
                        <div key="step-1" v-if="step === 1">
                            <div class="prose">
                                <h2>Step 1 - Installation</h2>
                                <p>Install the package in your project:</p>
                                <code>composer require larabug/larabug</code>
                                <p>Publish the config file:</p>
                                <p>
                                    Next is to add the <code>larabug</code> driver to the
                                    <code>logging.php</code> file:
                                </p>
                                <pre>
'channels' => [
    // ...
    'larabug' => [
        'driver' => 'larabug',
    ],
],
                </pre>
                                <p>
                                    After that you have configured the LaraBug channel you can add it to the stack
                                    section:
                                </p>
                                <pre>
'channels' => [
    'stack' => [
        'driver' => 'stack',
        'channels' => ['single', 'larabug'],
    ],
    //...
],
                </pre>
                            </div>
                        </div>

                        <div class="prose" key="step-2" v-if="step === 2">
                            <h2>Step 2 - Usage</h2>
                            <p>
                                Now all that is left to do is to add the 2 enviroment variables to your .env file:
                            </p>
                            <pre>
LB_KEY=18fRdiPBtVKqP76JLmgLIeuzv
LB_PROJECT_KEY=hN4Ui90S4CzaRqsADo0lZLA2WuDiG9MgTwebHTuLtjo32EWzvf
              </pre>
                            <p>Now test to see if it works, you can do this in two ways.</p>
                            <h3>Option 1</h3>
                            <p>Run this in your terminal:</p>
                            <code>php artisan larabug:test</code>
                            <h3>Option 2</h3>
                            <p>Run this code in your application to see if the exception is received by LaraBug.</p>
                            <code>throw new \Exception('Testing my application!');</code>
                        </div>
                    </TransitionGroup>
                </div>
            </div>

            <template #footer>
                <div class="flex items-center space-x-3">
                    <Button secondary>Close</Button>
                </div>
            </template>
        </Card>
    </Modal>
</template>

<script>
import Card from '@/Components/Card'
import Button from '@/Components/Button'
import Modal from '@/Components/Modal'

export default {
    components: {
        Card,
        Button,
        Modal,
    },
    props: {
        hasGuide: {
            required: false,
        },
    },
    data() {
        return {
            step: 1,
        }
    },
}
</script>
