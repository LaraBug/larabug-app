<template>
  <label :class="['text-base font-medium', { 'text-red-600': error }]">
    <slot></slot>
  </label>
</template>

<script>
export default {
  props: {
    error: {
      default: () => false,
    },
  },
}
</script>
