<template>
  <div
    :class="[
      'flex items-center border border-gray-300 divide-x divide-gray-200 rounded-md shadow-sm h-7 overflow-hidden',
      'transition duration-150 ease-in-out',
      'focus-within:shadow-focus',
    ]"
  >
    <slot></slot>
  </div>
</template>
