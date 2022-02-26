<template>
  <InertiaHead>
    <title>Issue for {{ project.title }} Project</title>
  </InertiaHead>

  <Header>
    <Breadcrumbs>
      <BreadcrumbsItem :href="route('panel.issues.index')">
        Issues
      </BreadcrumbsItem>

      <BreadcrumbsDivider />

      <BreadcrumbsItem :href="route('panel.issues.show', issue.id)">
        {{ issue.exception }}
      </BreadcrumbsItem>
    </Breadcrumbs>
  </Header>

  <Toolbar>
    <Button v-if="issue.status !== 'closed'" success @click="changeStatus('close')">Close issue</Button>
    <Button v-if="issue.status === 'closed'" success @click="changeStatus('open')">Reopen issue</Button>

    <Button v-if="issue.github_issue_url" primary @click="openUrl(issue.github_issue_url)">
      View on GitHub
    </Button>
  </Toolbar>

  <SplitContainer>
    <template v-slot:sidebar>
      <SidebarItem
          label="First occurrence"
          :content="issue.created_at"
      />

      <SidebarItem
          label="Last occurence"
          :content="issue.last_exception_at"
      />

      <SidebarItem
          label="Affected versions"
          :content="issue.affected_version"
      />

      <SidebarItem
          label="Environment"
          :content="exception.environment"
      />

      <SidebarItem
          label="Method"
          :content="exception.method"
      />

      <SidebarItem
          label="URL"
          :content="exception.fullUrl"
      />

      <SidebarItem
          label="File"
          :content="exception.file"
      />

      <SidebarItem
          label="Class"
          :content="exception.class"
      />

      <SidebarItem
          label="Line"
          :content="exception.line"
      />
    </template>

    <template v-slot:main>
      <div class="p-6 bg-white">
        <p>
          <span class="text-sm font-medium">Exception</span>
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
          <button
              class="h-12 px-3 text-xs font-medium text-gray-500 uppercase border-b-2 rounded-none"
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
    </template>
  </SplitContainer>
</template>

<script>
import MinimalLayout from "../../Layouts/MinimalLayout";
import Breadcrumbs from "../../Components/Breadcrumbs";
import BreadcrumbsItem from "../../Components/BreadcrumbsItem";
import BreadcrumbsDivider from "../../Components/BreadcrumbsDivider";
import Header from "../../Components/Header";
import Toolbar from "../../Components/Toolbar";
import Button from "../../Components/Button";
import SplitContainer from "../../Components/SplitContainer";
import SidebarItem from "../../Components/SidebarItem";
import Prism from "../../../plugins/prism";

export default {
  name: "Show",
  components: {SidebarItem, SplitContainer, Button, Toolbar, BreadcrumbsDivider, BreadcrumbsItem, Breadcrumbs, Header,},
  layout: MinimalLayout,
  props: {
    issue: {},
    exception: {},
    exceptions: {},
    project: {},
  },
  data() {
    return {
      tab: 'exception',
    }
  },
  mounted() {
    Prism.highlightAll();
  },
  methods: {
    changeStatus(status) {
      console.log(status);
    },
    openUrl(url) {
      window.open(url, '_blank');
    }
  },
}
</script>

<style scoped>

</style>