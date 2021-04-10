<template>
    <component
            :is="as"
            :class="[
      'inline-flex px-3 h-9 items-center justify-center font-bold text-sm rounded-lg',
      'transition duration-150 ease-in-out',
      'focus:outline-none focus:shadow-focus',

      { 'bg-primary-600 text-white shadow': primary },
      { 'hover:bg-primary-500': primary },
      { 'focus:bg-primary-700': primary },

      { 'border border-gray-300 text-gray-800 shadow-sm': secondary },
      { 'hover:border-gray-200': secondary },
      { 'focus:text-gray-900 focus:border-gray-300': secondary },
      
      { 'bg-red-600 text-white shadow': danger },
      { 'hover:bg-red-500': danger },
      { 'focus:bg-red-700': danger },
      
      { 'bg-green-600 text-white shadow': success },
      { 'hover:bg-green-500': success },
      { 'focus:bg-green-700': success },
    ]"
    >
        <slot></slot>
    </component>
</template>

<script>
export default {
    props: {
        primary: {
            type: Boolean,
            default: () => false,
        },
        secondary: {
            type: Boolean,
            default: () => false,
        },
        danger: {
            type: Boolean,
            default: () => false,
        },
        success: {
            type: Boolean,
            default: () => false,
        },
        as: {
            default: () => 'button',
        },
    },
}
</script>
