<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import {usePage} from "@inertiajs/vue3";
import {ref} from "vue";
import Pagination from "@/Components/Pagination.vue";

const failedRows = ref(usePage().props.failedRows.data)
const links = (usePage().props.failedRows.meta)


</script>

<template>
    <MainLayout>
        <div v-if="failedRows" class="relative rounded-xl overflow-auto">
            <div class="shadow-sm overflow-hidden my-8">
                <table class="border-collapse table-auto w-full text-sm rounded-xl">
                    <thead class="dark:bg-slate-900">
                    <tr>
                        <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pb-3 text-slate-400 dark:text-slate-200 text-left">Row</th>
                        <th class="border-b dark:border-slate-600 font-medium p-4 pb-3 text-slate-400 dark:text-slate-200 text-left">Key</th>
                        <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pb-3 text-slate-400 dark:text-slate-200 text-left">Message</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-slate-800">
                    <tr v-for="row in failedRows">
                        <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{row.row}}</td>
                        <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">{{row.key}}</td>
                        <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">{{row.message}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <Pagination :meta="links"></Pagination>
        </div>
    </MainLayout>
</template>

<style scoped>

</style>
