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
      Test 1234
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