<template>
<div class="w-4/6 mx-auto">
<Navigation></Navigation>

    <slot></slot>
</div>
</template>

<script>
import {Link} from "@inertiajs/vue3";

import Navigation from "@/Components/Navigation.vue";

export default {
    name: "MainLayout",

    components: {
        Link, Navigation
    }
}
</script>

<style scoped>

</style>
