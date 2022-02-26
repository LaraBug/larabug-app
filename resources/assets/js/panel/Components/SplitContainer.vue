<template>
  <div class="flex flex-col sm:flex-row flex-1">
    <aside class="w-full sm:w-1/4 sm:h-full bg-white border-r border-gray-200">
      <dl class="px-6 py-4 space-y-4">
        <slot name="sidebar"></slot>
      </dl>
    </aside>

    <div class="flex flex-1 flex-col divide-y divide-gray-200 overflow-hidden">
      <slot name="main"></slot>
    </div>
  </div>
</template>

<script>
export default {
  name: "SplitContainer"
}
</script>

<style scoped>

</style>