<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import CreateProductForm from '@/Pages/Products/Partials/CreateProductForm.vue';
</script>

<template>
    <AppLayout title="Create Product">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Create Product
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <CreateProductForm />
            </div>
        </div>
    </AppLayout>
</template>
