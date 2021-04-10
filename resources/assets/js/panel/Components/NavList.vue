<template>
  <ul class="flex-1" :class="big ? 'my-2' : ''">
    <slot></slot>
  </ul>
</template>

<script>
export default {
    props: {
        big: {
            default: true,
            type: Boolean
        }
    }
}
</script>