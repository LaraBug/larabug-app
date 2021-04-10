<template>
    <div class="flex flex-col space-y-8">
        <Breadcrumbs>
            <BreadcrumbsItem :href="route('panel.projects.index')">Projects</BreadcrumbsItem>
            <BreadcrumbsDivider/>
            <BreadcrumbsItem :href="route('panel.projects.show', project.id)">{{ project.title }}</BreadcrumbsItem>
            <BreadcrumbsDivider/>
            <BreadcrumbsItem href="/projects/show">Installation</BreadcrumbsItem>
        </Breadcrumbs>

        <Card>
            <template #header>
                <h2 class="text-xl font-bold">Installation guide</h2>
            </template>

            <div>
                <header class="sticky top-0 z-10 flex items-center bg-white border-b border-gray-200">
                    <button
                            class="inline-flex items-center justify-center h-12 px-6 text-sm font-medium"
                            :class="{'border-b border-blue-500' : step === 1 }"
                            @click="step = 1"
                    >
                        1. Installation
                    </button>
                    <button
                            class="inline-flex items-center justify-center h-12 px-6 text-sm font-medium"
                            :class="{'border-b border-blue-500' : step === 2 }"
                            @click="step = 2"
                    >
                        2. Usage
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
                                <pre>composer require larabug/larabug</pre>
                                <p>Publish the config file:</p>
                                <pre>php artisan vendor:publish --provider="LaraBug\ServiceProvider"</pre>
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
                                <Button primary @click="step = 2">Next</Button>
                            </div>
                        </div>

                        <div class="prose" key="step-2" v-if="step === 2">
                            <h2>Step 2 - Usage</h2>
                            <p>
                                Now all that is left to do is to add the 2 enviroment variables to your .env file:
                            </p>
                            <pre>
LB_KEY={{ $page.props.auth.user.api_token }}
LB_PROJECT_KEY={{ project.key }}
</pre>
                            <p>Now test to see if it works, you can do this in two ways.</p>
                            <h3>Option 1</h3>
                            <p>Run this in your terminal:</p>
                            <pre>php artisan larabug:test</pre>
                            <h3>Option 2</h3>
                            <p>Run this code in your application to see if the exception is received by LaraBug.</p>
                            <pre>throw new \Exception('Testing my application!');</pre>

                            <Button primary @click="step = 1">Back</Button>
                        </div>
                    </TransitionGroup>
                </div>
            </div>
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
import Paginator from '@/Components/Paginator'
import InstallationGuide from '@/Partials/InstallationGuide'
import EditProject from '@/Partials/EditProject'

export default {
    layout: AppLayout,
    components: {
        InstallationGuide,
        EditProject,
        Breadcrumbs,
        BreadcrumbsItem,
        BreadcrumbsDivider,
        Card,
        Button,
        ButtonRack,
        ButtonRackItem,
        Paginator,
        Badge,
    },
    props: {
        project: Object,
        guide: {
            default: () => false,
        },
    },
    data() {
        return {
            step: 1,
        }
    },
}
</script>
