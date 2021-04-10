<template>
    <input
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            :class="[
      'block w-full h-12 border max-w-lg border-gray-300 rounded form-input bg-gray-50',
      'transition duration-150 ease-in-out',
      { 'hover:border-gray-200': !error },
      { 'focus:shadow-form-focus-primary focus:border-primary-500 focus:bg-white': !error },

      { 'border-red-600 bg-red-50 text-red-600': error },
      { 'hover:border-red-500': error },
      { 'focus:shadow-form-focus-danger focus:border-red-600': error },
    ]"
    />
</template>

<script>
export default {
    props: {
        modelValue: {
            required: true,
        },
        error: {
            default: () => false,
        },
    },
}
</script>
