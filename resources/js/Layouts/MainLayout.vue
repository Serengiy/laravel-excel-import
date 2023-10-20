<script setup>
import {Link} from '@inertiajs/vue3'
import NavLink from "@/Components/NavLink.vue";

</script>

<template>
    <div class="w-3/4 mx-auto">
        <nav class="bg-gray-800">
            <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
                <div class="relative flex h-16 items-center justify-between">

                    <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                        <div class="flex flex-shrink-0 items-center">
                            <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
                        </div>
                        <div class=" sm:ml-6 sm:block">
                            <div class="flex space-x-4">
                                <Link :href="route('project.index')"
                                      :class="['rounded-md px-3 py-2 text-sm font-medium', $page.component === 'Project/Index' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white']"
                                      aria-current="page">Projects
                                </Link>
                                <Link :href="route('project.import')"
                                      :class="['rounded-md px-3 py-2 text-sm font-medium', $page.component === 'Project/Import' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white']"
                                      aria-current="page">Import
                                </Link>
                                <Link :href="route('task.index')"
                                      :class="['rounded-md px-3 py-2 text-sm font-medium', $page.component === 'Task/Index' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white']"
                                      aria-current="page">Tasks
                                </Link>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </nav>
        <slot/>
    </div>
</template>

<style scoped>

</style>
