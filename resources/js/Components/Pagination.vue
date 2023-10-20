<script setup>
import {usePage, Link} from "@inertiajs/vue3";

const props = defineProps({
    meta: Object
})
const meta = props.meta

</script>

<template>
    <nav aria-label="Page navigation example" class="">
        <ul class="flex  w-full justify-center">
<!--            <template>-->
                <li v-for="link in meta.links">
                    <Link :href="link.url" v-if="link.url" v-html="link.label"
                          :class="['flex items-center justify-center px-4 h-10  text-gray-500 border border-gray-300    dark:border-gray-700',
                            link.active
                             ?
                             'text-blue-600 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:bg-gray-700 dark:text-white'
                             :
                             'leading-tight text-gray-500 bg-white hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'
                          ]">
                    </Link>
                </li>
<!--            </template>-->

        </ul>
    </nav>
</template>

<style scoped>

</style>
