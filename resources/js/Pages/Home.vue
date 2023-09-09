<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';

defineProps({
    product: Object,
});
</script>

<template>
    <AppLayout title="Home">
        <div class="">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <!-- Card Product -->
                    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
                        <!-- Grid -->
                        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                            <!-- Card -->
                            <Link 
                                v-for="(item, i) in product.data"
                                :key="item.id"
                                :href="route('products.show', { product: item })" class="group flex flex-col bg-white border shadow-sm rounded-xl hover:shadow-md transition dark:bg-slate-900 dark:border-gray-800">
                                <div class="aspect-w-16 aspect-h-9">
                                    <img class="w-full object-cover rounded-t-xl aspect-video"
                                        :src="item.photo_path"
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
                                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
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
                    <Pagination :links="product.links"/>
                    <!-- End Pagination -->
                </div>
            </div>
        </div>
    </AppLayout>
</template>
