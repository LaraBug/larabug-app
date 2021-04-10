<template>
    <li>
        <inertia-link
                v-bind="$attrs"
                :class="[
        big ? 'h-11 px-4 flex space-x-3 items-center' : 'h-16 w-16 flex justify-center items-center',
        'transition duration-150 ease-in-out',
        'focus:outline-none',
        'hover:bg-primary-800',
        'focus:bg-primary-700',
        {
          'text-white bg-primary-800': isActive,
          'text-primary-300': !isActive,
        },
      ]"
        >
            <slot name="icon"></slot>

            <span class="font-medium text-base">
                <slot></slot>
              </span>
        </inertia-link>
    </li>
</template>

<script>

export default {
    props: {
        isActive: {
            default: false,
            type: Boolean
        },
        big: {
            default: true,
            type: Boolean
        }
    }
}
</script>
