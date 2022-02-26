<template>
  <div v-if="content">
    <dt class="text-sm font-medium">{{ label }}</dt>
    <dd>
      <Code>{{ content }}</Code>
    </dd>
  </div>
</template>

<script>
import Code from "./Code";
export default {
  name: "SidebarItem",
  components: {Code},
  props: {
    label: String,
    content: String,
  },
}
</script>

<style scoped>

</style>