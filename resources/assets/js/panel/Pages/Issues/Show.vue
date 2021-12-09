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
  </div>

<!--  <div class="flex w-full bg-white px-6 py-3 border-b border-gray-200 space-x-3">
    Space for statistics
  </div>-->

  <div class="w-full h-full flex bg-white relative overflow-y-hidden">
    <div class="flex-1 h-full px-6 py-3 border-r border-gray-200">
      <dl class="space-y-4">
        <div>
          <p>This issue caused <b class="font-bold">{{ issue.exception_count }}</b> times an exception</p>
        </div>

        <div v-if="issue.affected_versions">
          <dt class="text-sm font-medium">Affected versions</dt>
          <dd>
            <Code>{{ issue.affected_versions }}</Code>
          </dd>
        </div>

        <div v-if="exception.fullUrl">
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
          <dt class="text-sm font-medium">Reported</dt>
          <dd>
            <Code>{{ exception.created_at }}</Code>
          </dd>
        </div>
      </dl>
    </div>

    <div class="" style="width: 500px;">
      <ul class="divide-y divide-gray-200">
        <li v-for="exception in exceptions.data" :key="exception.id">
          <div :href="route('panel.exceptions.show', {id: project.id, exception: exception })"
               class="flex items-center px-6 py-4 space-x-6 hover:bg-gray-100">
            <div class="flex items-center space-x-2">
              <input
                  :class="[
      'text-primary-600 rounded border-gray-300 transition',
      'focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-offset-0',
    ]"
                  id="newsletter"
                  type="checkbox"
                  :value="exception.id"
                  v-model="selected"
              />
            </div>

            <inertia-link class="flex flex-1 items-center" :href="route('panel.exceptions.show', {id: project.id, exception: exception })">
              <div class="flex-1">
                <p class="font-medium text-bold"
                   v-bind:class="{'text-gray-500': exception.status === 'FIXED'}">
                </p>

                <div class="text-sm text-gray-600 flex flex-col">
                  <div>
                    <Badge success v-if="exception.status === 'FIXED'">{{ exception.status_text }}</Badge>
                    <Badge info v-if="exception.status === 'READ'">{{ exception.status_text }}</Badge>
                    <Badge danger v-if="exception.status === 'OPEN'">{{ exception.status_text }}</Badge>
                  </div>

                  <div>
                    <Badge info v-if="exception.snooze_until">Snoozed until {{ exception.snooze_until }}</Badge>
                    {{ exception.human_date }} &centerdot;
                    {{ exception.created_at }}
                    <Badge info v-if="exception.file_type === 'javascript'">&centerdot; Javascript</Badge>
                  </div>
                </div>
              </div>

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
}
</script>

<style scoped>

</style>