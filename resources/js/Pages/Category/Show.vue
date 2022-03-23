<script setup>
import BreezeButton from '@/Components/Button.vue';
import DeleteButton from '@/Components/DeleteButton';
import BreezeAuthLayout from '@/Layouts/Authenticated.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
  category: Object,
  filteredCommands: Object
})

const form = useForm({
    id: props.category.id,
    name: props.category.name
});

const submit = () => {
   
    form.patch(route('categories.update', form.id))
};

const remove = () => {
   
    form.delete(route('categories.destroy', form.id))
};
</script>

<template>
    <BreezeAuthLayout>
        <Head title="Category" />
        

        <div class="container mx-auto py-10 w-3/4 ">
            <h1 class="mb-8 text-3xl font-bold">Category</h1>
            <div class="flex justify-between mb-6">
                <h1 class="mb-8 text-2xl font-bold"></h1>
                <Link class="px-4 py-2 text-blue-400 hover:text-black-800 rounded-md " :href="`/categories/${form.id}/edit`">
                    <span class="font-bold">Edit</span>
                </Link>
            </div>
            <div>
                <BreezeLabel for="name" value="Name" />
                <BreezeInput id="name" type="text" class="mt-1 block w-full bg-black text-green-300" v-model="form.name" disabled/>
            </div>
        </div>

        <!-- Filtered Command Table gets redered here -->

        <div class="container mx-auto pt-10 w-3/4">
            <h1 class="mb-8 text-2xl font-bold">Commands</h1>
           
            <div class="bg-white rounded-md shadow overflow-x-auto mt-6">
                <table class="w-full whitespace-normal">
                    <thead>
                      <tr class="text-left font-bold">
                        <th class="pb-4 pt-6 px-6">Command</th>
                        <th class="pb-4 pt-6 px-6">Description</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in filteredCommands" :key="item.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                            <td class="border-t pb-3 pt-3 px-6">
                                <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="`/commands/${item.id}`">
                                  <p>{{ item.command }}</p>
                                </Link> 
                            </td>
                            <td class="border-t pb-3 pt-3 px-6">
                              <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="`/commands/${item.id}`">
                                  <p>{{ item.description }}</p>
                                </Link> 
                            </td>  
                        </tr>
                    </tbody>
                </table>
            </div>
           <!-- <Pagination class="mt-6" :links="commands.links" /> -->
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
