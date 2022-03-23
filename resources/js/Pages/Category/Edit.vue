<script setup>
import BreezeButton from '@/Components/Button.vue';
import DeleteButton from '@/Components/DeleteButton';
import BreezeAuthLayout from '@/Layouts/Authenticated.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
  category: Object
})

const form = useForm({
    id: props.category.id,
    name: props.category.name
});

const submit = () => {
   
    form.patch(route('categories.update', form.id))
};

const destroy = () => {
   
    form.delete(route('categories.destroy', form.id))
};
</script>

<template>
    <BreezeAuthLayout>
        <Head title="Edit Category" />

        <BreezeValidationErrors class="mb-4" />
        <div class="container mx-auto py-10 w-1/4">
            <h1 class="mb-8 text-3xl font-bold">Edit Category</h1>
            <form @submit.prevent="submit">
                <div>
                    <BreezeLabel for="category" value="Category" />
                    <BreezeInput id="category" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
                </div>
    
                <div class="flex items-center justify-end mt-4">
                    <DeleteButton class="ml-4" @click="destroy" type="button">
                        Delete
                    </DeleteButton>
                    <BreezeButton class="ml-4">
                        Edit Command
                    </BreezeButton>
                </div>
            </form>
       
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
