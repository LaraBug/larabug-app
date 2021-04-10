<template>
  <span
          :class="[
      'inline-flex h-5 px-1 text-xs font-bold rounded-full mr-1',
      { 'text-red-700 border border-red-200 bg-red-50': danger },
      { 'text-orange-700 border border-orange-200 bg-orange-50': warning },
      { 'text-green-700 border border-green-200 bg-green-50': success },
      { 'text-blue-700 border border-blue-200 bg-blue-50': info },
    ]"
  >
    <slot></slot>
  </span>
</template>

<script>
export default {
    props: {
        danger: {
            type: Boolean,
            default: () => false,
        },
        success: {
            type: Boolean,
            default: () => false,
        },
        warning: {
            type: Boolean,
            default: () => false,
        },
        info: {
            type: Boolean,
            default: () => false,
        }
    },
}
</script>
