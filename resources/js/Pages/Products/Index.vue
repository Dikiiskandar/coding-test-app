<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';

defineProps({
    product: Object,
});
</script>

<template>
    <AppLayout title="My Products">
        <template #header
            v-if="product.data.length > 0">
            <div class="flex">
                <h2 class="flex-1 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    My Products
                </h2>
                <Link :href="route('products.create')"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                Create Product
                </Link>
            </div>
        </template>
        <!-- Announcement Banner -->
        <Link 
            v-if="product.data.length == 0"
            class="group block bg-gray-100 hover:bg-gray-200 p-4 rounded-md text-center transition-all duration-300 dark:bg-white/[.05] dark:hover:bg-white/[.075]"
            :href="route('products.create')">
            <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto">
                <p class="mr-2 inline-block text-sm text-gray-800 dark:text-gray-200">
                    Currently the product is empty.
                </p>
                <span
                    class="group-hover:underline decoration-2 inline-flex justify-center items-center gap-x-2 font-semibold text-blue-600 text-sm dark:text-blue-500">
                    Create now
                    <svg class="w-2.5 h-2.5" width="16" height="16" viewBox="0 0 16 16" fill="none">
                        <path d="M5.27921 2L10.9257 7.64645C11.1209 7.84171 11.1209 8.15829 10.9257 8.35355L5.27921 14"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </span>
            </div>
        </Link>
        <!-- End Announcement Banner -->

        <div
            v-if="product.data.length > 0" 
            class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <!-- Card Product -->
                <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
                    <!-- Grid -->
                    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Card -->
                        <Link v-for="(item, i) in product.data" :key="item.id"
                            :href="route('products.show', { product: item })"
                            class="group flex flex-col bg-white border shadow-sm rounded-xl hover:shadow-md transition dark:bg-slate-900 dark:border-gray-800">
                        <div class="aspect-w-16 aspect-h-9">
                            <img class="w-full object-cover rounded-t-xl aspect-video" :src="item.photo_path"
                                alt="Image Description">
                        </div>
                        <div class="p-4 md:p-5">
                            <p class="mt-2 text-xs uppercase text-gray-600 dark:text-gray-400">
                                {{ item.team.name }}
                            </p>
                            <h3
                                class="mt-2 text-lg font-medium text-gray-800 group-hover:text-blue-600 dark:text-gray-300 dark:group-hover:text-white">
                                {{ item.name }}
                            </h3>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400 truncate">
                                {{ item.description }}
                            </p>
                        </div>
                        </Link>
                        <!-- End Card -->
                    </div>
                    <!-- End Grid -->
                </div>
                <!-- End Card Product -->

                <!-- Start Pagination -->
                <Pagination :links="product.links" />
                <!-- End Pagination -->
            </div>
        </div>
    </AppLayout>
</template>
