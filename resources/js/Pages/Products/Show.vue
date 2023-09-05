<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <AppLayout title="Dashboard">
        <div class="">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden py-2">
                    <!-- Detail Product -->
                    <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto">
                        <div class="grid lg:grid-cols-3 gap-y-8 lg:gap-y-0 lg:gap-x-6 lg:gap-x-12">
                            <!-- Content -->
                            <div class="lg:col-span-2">
                                <div class="py-8 lg:pr-4 lg:pr-8">
                                    <div class="space-y-5 lg:space-y-8">
                                        <Link class="inline-flex items-center gap-x-1.5 text-sm text-gray-600 decoration-2 hover:underline dark:text-blue-400"
                                            :href="route('products.index')">
                                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                                            </svg>
                                            Back to Products
                                        </Link>

                                        <h2 class="text-3xl font-bold lg:text-4xl lg:text-5xl dark:text-white">Iphone X - 256 Gb</h2>

                                        <div class="flex items-center gap-x-5">
                                            <a class="inline-flex items-center gap-1.5 py-1 px-3 sm:py-2 sm:px-4 rounded-full text-xs sm:text-sm bg-gray-100 text-gray-800 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-800 dark:text-gray-200"
                                                href="#">
                                                Toko Diki Serba Ada
                                            </a>
                                            <p class="text-xs sm:text-sm text-gray-800 dark:text-gray-200">January 18, 2023
                                            </p>
                                        </div>

                                        <figure>
                                            <img class="w-full object-cover rounded-xl"
                                                src="https://images.unsplash.com/photo-1671726203454-488ab18f7eda?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80"
                                                alt="Image Description">
                                        </figure>

                                        <p class="text-lg text-gray-800 dark:text-gray-200">At preline, our mission has
                                            always been focused on bringing openness and transparency to the design process.
                                            We've always believed that by providing a space where designers can share
                                            ongoing work not only empowers them to make better products, it also helps them
                                            grow.</p>

                                    </div>
                                </div>
                            </div>
                            <!-- End Content -->

                            <!-- Sidebar -->
                            <div
                                class="lg:col-span-1 lg:w-full lg:h-full lg:bg-gradient-to-r lg:from-gray-50 lg:via-transparent lg:to-transparent dark:from-slate-800">
                                <div class="sticky top-0 left-0 py-8 lg:pl-4 lg:pl-8">
                                    <!-- Store Profile -->
                                    <div
                                        class="group flex items-center gap-x-3 border-b border-gray-200 pb-8 mb-8 dark:border-gray-700">

                                        <a class="group grow block" href="">
                                            <h5
                                                class="group-hover:text-gray-600 text-sm font-semibold text-gray-800 dark:group-hover:text-gray-400 dark:text-gray-200">
                                                Toko Diki Serba Ada
                                            </h5>
                                        </a>
                                    </div>
                                    <!-- End Store Profile -->

                                    <div class="space-y-6">
                                        <!-- Store Products -->
                                        <a class="group flex items-center gap-x-6" href="#">
                                            <div class="grow">
                                                <span
                                                    class="text-sm font-bold text-gray-800 group-hover:text-blue-600 dark:text-gray-200 dark:group-hover:text-blue-500">
                                                    Iphone X - 256 Gb
                                                </span>
                                            </div>

                                            <div class="flex-shrink-0 relative rounded-lg overflow-hidden w-20 h-20">
                                                <img class="w-full h-full absolute top-0 left-0 object-cover rounded-lg"
                                                    src="https://images.unsplash.com/photo-1567016526105-22da7c13161a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1480&q=80"
                                                    alt="Image Description">
                                            </div>
                                        </a>
                                        <!-- End Store Products -->
                                    </div>
                                </div>
                            </div>
                            <!-- End Sidebar -->
                        </div>
                    </div>
                    <!-- End Detail Product -->
                </div>
            </div>
        </div>
    </AppLayout>
</template>
