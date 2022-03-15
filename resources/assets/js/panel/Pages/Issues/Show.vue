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

  <Toolbar class="">
    <div class="space-x-3 flex-1">
      <Button v-if="issue.status !== 'closed'" success @click="changeStatus('close')">Close issue</Button>
      <Button v-if="issue.status === 'closed'" success @click="changeStatus('open')">Reopen issue</Button>

      <Button v-if="issue.github_issue_url" primary @click="openUrl(issue.github_issue_url)">
        View on GitHub
      </Button>
    </div>

    <div class="flex items-center">
      <div class="text-green-500" style="width: 150px;">
        <svg xmlns="http://www.w3.org/2000/svg"
             style="fill: transparent;"
             class="w-full h-full text-brand bg-transparent"
             viewBox="0 -4 128 16"
             preserveAspectRatio="none"
             v-html="issue.sparkline"
        ></svg>
      </div>
    </div>
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
        <div class="flex mt-3 flex-wrap">
          <Badge v-for="label in issue.formatted_labels" :color="label.bgColor" :text-color="label.textColor" class="mb-1">{{ label.text }}</Badge>
        </div>
      </div>

      <div class="bg-white">
        <header class="flex items-center px-3">
          <button
              class="h-12 px-3 text-xs font-medium text-gray-500 uppercase border-b-2 rounded-none"
              :class="[ tab === 'all-exceptions' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500']"
              @click="tab = 'all-exceptions'"
          >
            All exceptions
          </button>
          <button
              class="h-12 px-3 text-xs font-medium uppercase border-b-2 rounded-none"
              :class="[ tab === 'exception' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500']"
              @click="tab = 'exception'"
          >
            First exception
          </button>
          <button
              class="h-12 px-3 text-xs font-medium text-gray-500 uppercase border-b-2 rounded-none"
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

        <div v-show="tab === 'all-exceptions'">
          <Card>
            <ul class="divide-y divide-gray-200">
              <li v-for="exception in exceptions.data" :key="exception.id">
                <div :href="route('panel.exceptions.show', {id: project.id, exception: exception })"
                     class="flex items-center px-6 py-4 space-x-6 hover:bg-gray-100">
                  <inertia-link class="flex flex-1 items-center" :href="route('panel.exceptions.show', {id: project.id, exception: exception })">
                    <div class="flex-1">
                      <p class="font-medium text-bold"
                         v-bind:class="{'text-gray-500': exception.status === 'FIXED'}">
                      </p>

                      <p class="text-sm text-gray-600">
                        <Badge success v-if="exception.status === 'FIXED'">{{ exception.status_text }}</Badge>
                        <Badge info v-if="exception.status === 'READ'">{{ exception.status_text }}</Badge>
                        <Badge danger v-if="exception.status === 'OPEN'">{{ exception.status_text }}</Badge>
                        <span v-if="exception.snooze_until">&centerdot; </span>
                        <Badge info v-if="exception.snooze_until">Snoozed until {{ exception.snooze_until }}</Badge>
                        &centerdot; {{ exception.human_date }} &centerdot;
                        {{ exception.created_at }}
                        <Badge info v-if="exception.file_type === 'javascript'">&centerdot; Javascript</Badge>
                      </p>
                    </div>
                    <div class="flex-1"></div>

                    <span v-if="exception.project_version"><Badge gray big>{{ exception.project_version }}</Badge></span>

                    <span v-if="exception.environment"><Badge gray big>{{ exception.environment }}</Badge></span>

                    <svg
                        class="w-6 h-6 text-gray-500"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                          fill-rule="evenodd"
                          d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                          clip-rule="evenodd"
                      ></path>
                    </svg>
                  </inertia-link>
                </div>
              </li>
            </ul>

            <template #footer>
              <Paginator :paginated="exceptions"/>
            </template>
          </Card>
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
import Badge from "../../Components/Badge";
import Card from "../../Components/Card";
import Paginator from "../../Components/Paginator";

export default {
  name: "Show",
  components: {
    Paginator,
    Card,
    Badge,
    SidebarItem, SplitContainer, Button, Toolbar, BreadcrumbsDivider, BreadcrumbsItem, Breadcrumbs, Header,},
  layout: MinimalLayout,
  props: {
    issue: {},
    exception: {},
    exceptions: {},
    project: {},
  },
  data() {
    return {
      tab: 'all-exceptions',
      form: {
        search: null,
      },
      selected: [],
    }
  },
  mounted() {
    Prism.highlightAll();
  },
  methods: {
    changeStatus(status) {
      if (status === 'open') {
        this.$inertia.post(this.route('panel.issues.open', this.issue.id));
      } else {
        this.$inertia.post(this.route('panel.issues.close', this.issue.id));
      }
    },
    openUrl(url) {
      window.open(url, '_blank');
    }
  },
}
</script>

<style scoped>

</style>