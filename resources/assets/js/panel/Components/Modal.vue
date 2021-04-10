<template>
  <div
    v-if="isOpen"
    class="fixed inset-0 z-50 flex flex-col items-center w-full h-screen overflow-y-auto bg-black bg-opacity-50"
  >
    <InertiaLink :href="closeLink" class="absolute inset-0 z-0 w-full h-full">
      Close modal
    </InertiaLink>

    <div class="z-10 w-full max-w-3xl p-8">
      <slot></slot>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    isOpen: {
      type: Boolean,
      default: () => false,
    },
    closeLink: {
      required: true,
    },
  },
}
</script>
