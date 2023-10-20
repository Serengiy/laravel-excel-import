<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import { ref,reactive } from 'vue';
import { useForm } from "@inertiajs/vue3";

const fileInput = ref(null)
const error = reactive(ref(null))
const form = (useForm({
    file: null,
    type: 1,
}))
const file = ref(null)
const selectExcel = () =>{
    fileInput.value.click()
}
const setExcelFile = (e) => {
    error.value = null
    form.file = e.target.files[0]
}
const sendExcel = () =>{
    form.post( '/projects/import', {
        onSuccess:(res)=>{
            console.log(res)
        },
        onError:(res) =>{
            error.value = res.error
        }
    })
}

</script>

<template>
    <MainLayout>
        <div>
            <div class="flex flex-col items-center">
                <h1 class="text-center text-lg my-5">File import</h1>
                <input type="file" ref="fileInput" class="hidden" @change="setExcelFile">
                <div class="flex gap-4">
                    <input v-model="form.type" class="rounded-full py-2" type="number" min="1" max="2">
                    <a @click.prevent="selectExcel" href="#" class="border hover:border-gray-800 block rounded-full bg-green-600 text-white p-2 w-36 text-center">Excel</a>
                    <a v-if="form.file" @click.prevent="sendExcel" href="#" class="border hover:border-gray-800 block rounded-full bg-sky-600 text-white p-2 w-36 text-center">Import</a>
                </div>
                <div v-if="error">
                    <p class="text-sm text-red-600 mt-3">{{error}}</p>
                </div>
            </div>
        </div>
    </MainLayout>

</template>

<style scoped>

</style>
