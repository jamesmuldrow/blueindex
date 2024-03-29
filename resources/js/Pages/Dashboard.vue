<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import BreezeInput from '@/Components/Input.vue';
import debounce from "lodash/debounce";
import { Inertia } from "@inertiajs/inertia";
import Pagination from '@/Components/Pagination.vue';

import { watch, ref } from "vue";

let search = ref('');

watch(search, debounce(() => {
    
    Inertia.get('/dashboard', {search: search.value}, {
        preserveState: true,
        replace: true
    });
    
}, 500));

const props = defineProps({
  commands: Object,
  categories: Object,
  filters: Object,
})
</script>

<template>
    <Head title="Dashboard" />
    
    <BreezeAuthenticatedLayout>
        <div class="container mx-auto pt-10">

            <div class="" style="text-align:center;">
                <BreezeInput class="border w-1/2 py-2 px-4 rounded-xl" autofocus v-model="search" placeholder="Search">Search...</BreezeInput>
            </div>
            <div class="grid grid-cols-4 gap-4 pt-10">
                <div style="text-align:left;">
                    <div class="flex justify-between mb-6">
                        <strong>Categories</strong>
                        <Link class="flex items-center text-sky-400 focus:text-indigo-500" :href="`/categories/create`">
                            Add Category
                        </Link>
                    </div>
                    
                    <table class="w-full whitespace-normal">
                        <tbody>
                            <tr v-for="item in categories.data" :key="item.id" class="shadow focus-within:bg-gray-100">
                                <td class="pb-2 pt-2 px-4">
                                    <Link class="flex items-center px-4 py-2 focus:text-indigo-500" :href="`/categories/${item.id}`">
                                        <p>{{ item.name }}</p>
                                    </Link> 
                                </td> 
                            </tr>
                        </tbody>
                    </table>
                    <Pagination class="mt-6" :links="categories.links" />
                </div>
                <div class="col-span-2 rounded-md overflow-x-auto mt-6" style="text-align:center;">
                <table class="w-full whitespace-normal">
                    <tbody>
                        <tr v-if="search" v-for="item in commands.data" :key="item.id" class="bg-white shadow hover:bg-gray-100 focus-within:bg-gray-100">
                            <td class="border-t pb-2 pt-2 px-4">
                                <Link class="flex items-center px-4 py-2 focus:text-indigo-500" :href="`/commands/${item.id}`">
                                  <p>{{ item.command }}</p>
                                </Link> 
                            </td>
                            <td class="border-t pb-3 pt-3 px-6">
                              <Link class="flex items-center px-4 py-2 focus:text-indigo-500" :href="`/commands/${item.id}`">
                                  <p>{{ item.description }}</p>
                                </Link> 
                            </td>  
                        </tr>
                    </tbody>
                </table>
                </div>
               <div style="text-align:center;">
                  Favorites go here - This is a list of the users favorite commands.
               </div>
            </div>
        </div>
       
    </BreezeAuthenticatedLayout>
</template>

<style scoped>
    .bg-gray-100 {
        background-color: #f7fafc;
        background-color: rgba(247, 250, 252, var(--tw-bg-opacity));
    }

    .border-gray-200 {
        border-color: #edf2f7;
        border-color: rgba(237, 242, 247, var(--tw-border-opacity));
    }

    .text-gray-400 {
        color: #cbd5e0;
        color: rgba(203, 213, 224, var(--tw-text-opacity));
    }

    .text-gray-500 {
        color: #a0aec0;
        color: rgba(160, 174, 192, var(--tw-text-opacity));
    }

    .text-gray-600 {
        color: #718096;
        color: rgba(113, 128, 150, var(--tw-text-opacity));
    }

    .text-gray-700 {
        color: #4a5568;
        color: rgba(74, 85, 104, var(--tw-text-opacity));
    }

    .text-gray-900 {
        color: #1a202c;
        color: rgba(26, 32, 44, var(--tw-text-opacity));
    }

    @media (prefers-color-scheme: dark) {
        .dark\:bg-gray-800 {
            background-color: #2d3748;
            background-color: rgba(45, 55, 72, var(--tw-bg-opacity));
        }

        .dark\:bg-gray-900 {
            background-color: #000000;
            
        }

        .dark\:border-gray-700 {
            border-color: #4a5568;
            border-color: rgba(74, 85, 104, var(--tw-border-opacity));
        }

        .dark\:text-white {
            color: #fff;
            color: rgba(255, 255, 255, var(--tw-text-opacity));
        }

        .dark\:text-gray-400 {
            color: #cbd5e0;
            color: rgba(203, 213, 224, var(--tw-text-opacity));
        }
    }
</style>
