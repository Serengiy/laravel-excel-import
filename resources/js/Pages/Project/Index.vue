<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import {usePage} from "@inertiajs/vue3";
import Pagination from "@/Components/Pagination.vue";
import {ref} from "vue";

const projects = ref(usePage().props.projects.data)
const links = ref(usePage().props.projects.meta)

</script>

<template>
  <MainLayout>
      <div v-if="projects" class="relative rounded-xl overflow-auto">
          <div class="shadow-sm overflow-auto my-8">
              <table class="border-collapse table-auto w-full text-sm rounded-xl">
                  <thead class="dark:bg-slate-900">
                  <tr>
                      <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pb-3 text-slate-400 dark:text-slate-200 text-left">Id</th>
                      <th class="border-b dark:border-slate-600 font-medium p-4 pb-3 text-slate-400 dark:text-slate-200 text-left">Title</th>
                      <th class="border-b dark:border-slate-600 font-medium p-4 pb-3 text-slate-400 dark:text-slate-200 text-left">Type</th>
                      <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pb-3 text-slate-400 dark:text-slate-200 text-left">Created at time</th>
                      <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pb-3 text-slate-400 dark:text-slate-200 text-left">Contracted at</th>
                      <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pb-3 text-slate-400 dark:text-slate-200 text-left">Deadline</th>
                      <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pb-3 text-slate-400 dark:text-slate-200 text-left">Is on time</th>
                      <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pb-3 text-slate-400 dark:text-slate-200 text-left">Has outsource</th>
                      <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pb-3 text-slate-400 dark:text-slate-200 text-left">Has investors</th>
                      <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pb-3 text-slate-400 dark:text-slate-200 text-left">Worker count</th>
                  </tr>
                  </thead>
                  <tbody class="bg-white dark:bg-slate-800">
                  <tr v-for="project in projects">
                      <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{project.id}}</td>
                      <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">{{project.title}}</td>
                      <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">{{project.type}}</td>
                      <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">{{project.created_at_time}}</td>
                      <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">{{project.contracted_at}}</td>
                      <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">{{project.deadline}}</td>
                      <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">{{project.is_on_time}}</td>
                      <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">{{project.has_outsource}}</td>
                      <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">{{project.has_investors}}</td>
                      <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">{{project.worker_count}}</td>
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
