<template>
<div v-if="meta.links.length > 0">
    <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
            <div>
                <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                    <template v-for="link in meta.links">
                    <Link  v-if="link.url" :href="link.url" v-html="link.label"
                          :class="
                          ['relative inline-flex items-center border px-4 py-2 text-sm font-medium focus:z-20',
                          link.active ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600' : 'bg-white border-gray-300 text-gray-500 :hover:bg-gray-50']">

                    </Link>
                    </template>
                </nav>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import {Link} from "@inertiajs/vue3";

export default {
    name: "Pagination",


    components: {
        Link
    },

    props: [
        'meta'
    ]
}
</script>

<style scoped>

</style>
