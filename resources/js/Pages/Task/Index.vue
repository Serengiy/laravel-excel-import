<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import {usePage, Link, router} from "@inertiajs/vue3";
import {ref} from "vue";
import Pagination from "@/Components/Pagination.vue";

const tasks = ref(usePage().props.tasks.data)
const links = ref(usePage().props.tasks.meta)

</script>

<template>
    <MainLayout>
        <div v-if="tasks" class="relative rounded-xl overflow-auto">
            <div class="shadow-sm overflow-hidden my-8">
                <table class="border-collapse table-auto w-full text-sm rounded-xl">
                    <thead class="dark:bg-slate-900">
                    <tr>
                        <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pb-3 text-slate-400 dark:text-slate-200 text-left">User</th>
                        <th class="border-b dark:border-slate-600 font-medium p-4 pb-3 text-slate-400 dark:text-slate-200 text-left">Task</th>
                        <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pb-3 text-slate-400 dark:text-slate-200 text-left">Status</th>
                        <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pb-3 text-slate-400 dark:text-slate-200 text-left">Failed</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-slate-800">
                    <tr v-for="task in tasks">
                        <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{task.user.name}}</td>
                        <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">{{task.file.path}}</td>
                        <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">{{task.status}}</td>
                        <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-sky-500 dark:text-sky-400">
                            <Link v-if="task.failed_rows" :href="route('task.failed', { task: task.id })">{{ task.failed_rows }}</Link>
                            <p class="text-slate-400" v-if="!task.failed_rows">Downloaded with no errors</p>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <Pagination :meta="links"></Pagination>

            </div>
        </div>
    </MainLayout>
</template>

<style scoped>

</style>
