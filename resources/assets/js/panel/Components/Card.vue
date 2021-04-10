<template>
  <div class="bg-white shadow rounded-lg divide-y divide-gray-200">
    <header class="px-6 py-4 flex items-center justify-between" v-if="$slots.header">
      <slot name="header"></slot>
    </header>

    <div :class="{ 'p-6': contained }">
      <slot></slot>
    </div>

    <footer class="px-6 py-3" v-if="$slots.footer">
      <slot name="footer"></slot>
    </footer>
  </div>
</template>

<script>
export default {
  props: {
    contained: {
      type: Boolean,
      default: () => false,
    },
  },
}
</script>
