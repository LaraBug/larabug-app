<template>
    <div class="flex items-center justify-between">
        <p class="text-sm text-gray-600">{{ paginated.total }} results</p>

        <div
                class="inline-flex text-gray-500 border border-gray-300 divide-x divide-gray-300 rounded-lg shadow-sm"
        >
            <component :is="paginated.prev_page_url ? 'inertia-link' : 'button'" :href="paginated.prev_page_url" class="inline-flex items-center justify-center w-8 h-8 rounded-none" :class="[!paginated.prev_page_url ? 'opacity-50' : '']">
                <svg
                        class="w-5 h-5"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                            fill-rule="evenodd"
                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                            clip-rule="evenodd"
                    ></path>
                </svg>
            </component>
            <component :is="paginated.next_page_url ? 'inertia-link' : 'button'" :href="paginated.next_page_url" class="inline-flex items-center justify-center w-8 h-8 rounded-none" :class="[!paginated.next_page_url ? 'opacity-50' : '']">
                <svg
                        class="w-5 h-5"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                            fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"
                    ></path>
                </svg>
            </component>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        paginated: {
            type: Object,
            default: {
                total: 0
            }
        }
    }
}
</script>
