<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeAuthLayout from '@/Layouts/Authenticated.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, Link, useForm} from '@inertiajs/inertia-vue3';
import { Inertia } from "@inertiajs/inertia";
import Pagination from '@/Components/Pagination.vue';

import { watch, ref } from "vue";
 
let search = ref(props.filters.search);

watch(search, value => {
    console.log('Changed ' + value);
    Inertia.get('/commands', {search: value}, {
        preserveState: true
    });
    
});

const props = defineProps({
  commands: Object,
  filters: Object,
})

const form = useForm({
    command: '',
    description: '',
});

const submit = () => {
    form.post(route('commands.store'));
};
</script>

<template>
    <BreezeAuthLayout>
        <Head title="Commands" />
        
        
        <div class="container mx-auto pt-10 w-3/4">
            <!--<h1 class="mb-8 text-3xl font-bold">Commands</h1>-->
            <div class="flex justify-between mb-6">
                
                <BreezeInput class="border px-2 rounded-xl" v-model="search" placeholder="Search commands ...">Search...</BreezeInput>
            
                <Link class="px-4 py-2 text-black-900 hover:text-black-800 bg-blue-200 rounded-md " href="/commands/create">
                    <span class="font-bold">Add</span>
                </Link>
            </div>
           
            <div class="bg-white rounded-md shadow overflow-x-auto mt-6">
                <table class="w-full whitespace-normal">
                    <thead>
                      <tr class="text-left font-bold">
                        <th class="pb-4 pt-6 px-6">Command</th>
                        <th class="pb-4 pt-6 px-6">Description</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in commands.data" :key="item.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                            <td class="border-t pb-3 pt-3 px-6">
                                <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="`/commands/${item.id}/edit`">
                                  <p>{{ item.command }}</p>
                                </Link> 
                            </td>
                            <td class="border-t pb-3 pt-3 px-6">
                              <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="`/commands/${item.id}/edit`">
                                  <p>{{ item.description }}</p>
                                </Link> 
                            </td>  
                        </tr>
                    </tbody>
                </table>
            </div>
            <Pagination class="mt-6" :links="commands.links" />
        </div>
        
    </BreezeAuthLayout>
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

<script>

export default {
    components: {
        Pagination,
    },
}
    
</script>
