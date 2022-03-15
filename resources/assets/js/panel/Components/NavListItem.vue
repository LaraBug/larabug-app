<template>
	<li>
		<component
			:is="is"
			v-bind="is !== 'button' ? $attrs: null"
			:class="[
        big ? 'h-11 px-4 flex space-x-3 items-center' : 'space-x-3 md:space-x-0 h-11 md:h-16 md:w-16 px-4 md:px-none flex md:justify-center items-center transition',
        'focus:outline-none',
        'hover:bg-primary-800',
        'focus:bg-primary-700',
        is === 'button' ? 'w-full' : '',
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
		</component>
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
		},
		is: {
			default: 'inertia-link'
		}
	}
}
</script>
