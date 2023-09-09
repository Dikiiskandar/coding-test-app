<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import UpdateProductForm from '@/Pages/Products/Partials/UpdateProductForm.vue';

defineProps({
    product: Object
});
</script>

<template>
    <AppLayout title="Edit Product">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Edit Product
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <UpdateProductForm :product="product"/>
            </div>
        </div>
    </AppLayout>
</template>
