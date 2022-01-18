<template>
  <InertiaHead>
    <title>Issue: {{ issue.exception }}</title>
  </InertiaHead>

  <header class="flex items-center w-full h-16 px-6 bg-white border-b border-gray-200">
    <Breadcrumbs>
      <BreadcrumbsItem :href="route('panel.issues.index')">Issues</BreadcrumbsItem>
      <BreadcrumbsDivider/>
      <BreadcrumbsItem :href="route('panel.issues.show', issue.id)">{{ issue.exception }}</BreadcrumbsItem>
    </Breadcrumbs>
  </header>

  <div class="flex w-full bg-white px-6 py-3 border-b border-gray-200 space-x-3">
    <Button v-if="issue.status !== 'FIXED'" success>Mark as fixed</Button>

    <Button v-if="issue.status == 'FIXED'" primary>Reopen issue</Button>

    <Button @click="openUrl(issue.github_issue_url)" v-if="issue.github_issue_url" primary>View on GitHub</Button>
  </div>

<!--  <div class="flex w-full bg-white px-6 py-3 border-b border-gray-200 space-x-3">
    Space for statistics
  </div>-->

  <div class="w-full h-full flex relative overflow-y-hidden">
    <aside class="w-full sm:w-1/4 sm:h-full bg-white border-r border-gray-200">
      <dl class="px-6 py-4 space-y-4">
        <div>
          <p>This issue caused <b class="font-bold">{{ issue.exception_count }}</b> times an exception.</p>
        </div>

        <div>
          <dt class="text-sm font-medium">Project</dt>
          <dd>
            <Code>{{ project.title }}</Code>
          </dd>
        </div>

        <div v-if="issue.affected_versions">
          <dt class="text-sm font-medium">Affected versions</dt>
          <dd>
            <Code>{{ issue.affected_versions }}</Code>
          </dd>
        </div>

        <div v-if="exception && exception.fullUrl">
          <dt class="text-sm font-medium">URL</dt>
          <dd>
            <Code>{{ exception.fullUrl }}</Code>
          </dd>
        </div>

        <div v-if="exception.file">
          <dt class="text-sm font-medium">File</dt>
          <dd>
            <Code>{{ exception.file }}</Code>
          </dd>
        </div>

        <div v-if="exception.class">
          <dt class="text-sm font-medium">Class</dt>
          <dd>
            <Code>{{ exception.class }}</Code>
          </dd>
        </div>

        <div>
          <dt class="text-sm font-medium">Line</dt>
          <dd>
            <Code>{{ exception.line }}</Code>
          </dd>
        </div>

        <div>
          <dt class="text-sm font-medium">First report</dt>
          <dd>
            <Code>{{ issue.created_at }}</Code>
          </dd>
        </div>
      </dl>
    </aside>

    <div class="flex-1 px-6 py-4 space-y-4 border-r border-gray-200">
      <h2 class="text-2xl font-bold">Timeline</h2>

      <div class="relative overflow-hidden h-full">
        <div class="space-y-5">
          <div
            class="bg-white border border-gray-200 rounded-lg p-5 space-y-2"
            v-for="(event, index) in events"
            :key="index"
          >
            <p class="text-md"><span v-html="event.content"></span> by {{ event.causer }} </p>
            <p class="text-gray-600 text-sm">
              <b class="font-medium">{{ event.action }}</b> at {{ event.created_at }}
            </p>
          </div>
        </div>

      </div>

    </div>
  </div>
</template>

<script>
import CompactLayout from "../../Layouts/CompactLayout";
import Breadcrumbs from "../../Components/Breadcrumbs";
import BreadcrumbsItem from "../../Components/BreadcrumbsItem";
import BreadcrumbsDivider from "../../Components/BreadcrumbsDivider";
import Button from "../../Components/Button";
import Badge from "../../Components/Badge";
import Card from "../../Components/Card";
import Paginator from "../../Components/Paginator";
import Code from "../../Components/Code";

export default {
  name: "Show",
  components: {Code, Paginator, Card, Badge, Button, BreadcrumbsDivider, BreadcrumbsItem, Breadcrumbs},
  layout: CompactLayout,
  props: {
    issue: {},
    events: {},
    project: {},
    exception: {},
    exceptions: {},
  },
  data() {
    return {
      form: {
        search: null,
      },

      selected: [],
    }
  },
  methods: {
    openUrl(url) {
      window.open(url, '_blank');
    },
  },
}
</script>

<style scoped>

</style>