<template>
  <span
      :class="[
        'inline-flex items-center h-5 px-2 text-xs font-bold rounded-full mr-1',
        { 'text-red-700 border border-red-200 bg-red-50': danger },
        { 'text-orange-700 border border-orange-200 bg-orange-50': warning },
        { 'text-green-700 border border-green-200 bg-green-50': success },
        { 'text-blue-700 border border-blue-200 bg-blue-50': info },
        { 'text-gray-700 border border-gray-200 bg-gray-50': gray },
        { 'text-md h-7 px-2': big },
      ]"
      :style="[{
        'backgroundColor': color,
      }, {
        'color': textColor,
      }]"
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
        },
        gray: {
            type: Boolean,
            default: () => false,
        },
        big: {
            type: Boolean,
            default: () => false,
        },
        color: {
            type: String,
            required: false,
        },
        textColor: {
            type: String,
            required: false,
        },
    },
}
</script>
