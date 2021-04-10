<template>
    <div class="flex items-center space-x-2">
        <input
                v-bind="$attrs"
                :class="[
        'form-checkbox text-primary-600',
        'transition duration-150 ease-in-out',
        'focus:outline-none focus:shadow-focus',
      ]"
                type="checkbox"
                :value="modelValue"
                :checked="modelValue"
                @change="$emit('update:modelValue', $event.target.value)"
        />

        <label class="text-sm font-medium" :for="$attrs.id">
            {{ label }}
        </label>
    </div>
</template>

<script>
export default {
    inheritAttrs: false,
    props: {
        label: {
            type: String,
            required: true,
        },
        modelValue: {
            required: true,
        },
    },
}
</script>
