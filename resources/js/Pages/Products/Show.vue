<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import DangerButton from '@/Components/DangerButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    product: Object,
    recomendedProducts: Array,
    currentTeam: Object,
    ownedPermissions: Array,
});

const confirmingProductDeletion = ref(false);
const form = useForm({});

const confirmProductDeletion = () => {
    confirmingProductDeletion.value = true;
};

const deleteProduct = () => {
    form.delete(route('products.destroy', props.product), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingProductDeletion.value = false;

    form.reset();
};

</script>

<template>
    <AppLayout :title="'Show Product -' + product.name">
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
                                        <Link
                                            class="inline-flex items-center gap-x-1.5 text-sm text-gray-600 decoration-2 hover:underline dark:text-blue-400"
                                            :href="route('home')">
                                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                                        </svg>
                                        Back to Home
                                        </Link>

                                        <h2 class="text-3xl font-bold lg:text-4xl lg:text-5xl dark:text-white">
                                            {{ product.name }}
                                            <span class="text-xs text-gray-800 dark:text-gray-200">{{ product.uuid }}</span>
                                        </h2>

                                        <div class="flex">
                                            <div class="flex items-center gap-x-5 flex-1">
                                                <a class="inline-flex items-center gap-1.5 py-1 px-3 sm:py-2 sm:px-4 rounded-full text-xs sm:text-sm bg-gray-100 text-gray-800 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-800 dark:text-gray-200"
                                                    href="#">
                                                    {{ product.team.name }}
                                                </a>
                                                <a class="inline-flex items-center gap-1.5 py-1 px-3 sm:py-2 sm:px-4 rounded-full text-xs sm:text-sm bg-gray-100 text-gray-800 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-800 dark:text-gray-200"
                                                    href="#">
                                                    {{ product.created_at }}
                                                </a>
                                                <a class="inline-flex items-center gap-1.5 py-1 px-3 sm:py-2 sm:px-4 rounded-full text-xs sm:text-sm bg-gray-100 text-gray-800 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-800 dark:text-gray-200"
                                                    href="#">
                                                    Stock: {{ product.sku }}
                                                </a>
                                            </div>
                                            <div v-if="currentTeam && currentTeam.id == product.team.id"
                                                class="flex items-center gap-x-2">
                                                <Link v-if="['update', '*'].some(i => ownedPermissions.includes(i))"
                                                    :href="route('products.edit', { product })"
                                                    class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                                Edit
                                                </Link>

                                                <DangerButton v-if="['delete', '*'].some(i => ownedPermissions.includes(i))"
                                                    @click="confirmProductDeletion">
                                                    Delete Product
                                                </DangerButton>
                                            </div>
                                        </div>

                                        <figure>
                                            <img class="w-full object-cover rounded-xl" :src="product.photo_path"
                                                alt="Image Description">
                                        </figure>
                                        <div class="space-y-3">
                                            <h3 class="text-2xl font-semibold dark:text-white">Description</h3>
                                            <p class="text-lg text-gray-800 dark:text-gray-200">{{ product.description }}
                                            </p>
                                        </div>
                                        <div class="space-y-3">
                                            <h3 class="text-2xl font-semibold dark:text-white">Specification</h3>
                                            <p class="text-lg text-gray-800 dark:text-gray-200">{{ product.specification }}
                                            </p>
                                        </div>

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
                                                {{ product.team.name }}
                                            </h5>
                                        </a>
                                    </div>
                                    <!-- End Store Profile -->

                                    <div class="space-y-6">

                                        <p class="text-sm text-center text-gray-500">
                                            Another Product
                                        </p>
                                        <!-- Store Products -->
                                        <a v-for="(product, i) in recomendedProducts" :key="product.id"
                                            :href="route('products.show', { product })"
                                            class="group flex items-center gap-x-6">
                                            <div class="grow">
                                                <span
                                                    class="text-sm font-bold text-gray-800 group-hover:text-blue-600 dark:text-gray-200 dark:group-hover:text-blue-500">
                                                    {{ product.name }}
                                                </span>
                                            </div>

                                            <div class="flex-shrink-0 relative rounded-lg overflow-hidden w-20 h-20">
                                                <img class="w-full h-full absolute top-0 left-0 object-cover rounded-lg"
                                                    :src="product.photo_path" alt="Image Description">
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

            <!-- Delete Product Confirmation Modal -->
            <DialogModal :show="confirmingProductDeletion" @close="closeModal">
                <template #title>
                    Delete Product
                </template>

                <template #content>
                    Are you sure you want to delete this product? Once your product is deleted, all of its resources and
                    data will be permanently deleted.
                </template>

                <template #footer>
                    <SecondaryButton @click="closeModal">
                        Cancel
                    </SecondaryButton>

                    <DangerButton class="ml-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                        @click="deleteProduct">
                        Delete Product
                    </DangerButton>
                </template>
            </DialogModal>
        </div>
    </AppLayout>
</template>
