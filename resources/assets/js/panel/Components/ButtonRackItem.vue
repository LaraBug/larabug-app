<template>
  <component
    :is="as"
    :class="[
      'inline-flex items-center justify-center h-7 px-2 text-sm font-medium text-gray-700 rounded-none',
      'transition duration-150 ease-in-out',
      'focus:outline-none',
      'hover:text-gray-600',
      'focus:text-gray-800 focus:bg-primary-50',
    ]"
  >
    <slot></slot>
  </component>
</template>

<script>
export default {
  props: {
    as: {
      default: () => 'button',
    },
  },
}
</script>
