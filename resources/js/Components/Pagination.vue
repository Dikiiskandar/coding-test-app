<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    links: Array,
});

const activeClass = ref("w-10 h-10 bg-blue-500 text-white p-4 inline-flex items-center text-sm font-medium rounded-full");
const defaultClass = ref("w-10 h-10 text-gray-500 hover:text-blue-600 p-4 inline-flex items-center text-sm font-medium rounded-full");

</script>
<template>
    <div>
        <nav class="flex justify-center items-center space-x-2 mb-10 lg:mb-14">
            <div v-for="(link, i) in links">
                <Link 
                    v-if="link.label.includes('Previous')"
                    class="text-gray-500 hover:text-blue-600 p-4 inline-flex items-center gap-2 rounded-md"
                    :href="link.url ?? '#'">
                        <span aria-hidden="true">«</span>
                        <span class="sr-only">Previous</span>
                </Link>
                <Link 
                    v-else-if="link.label.includes('Next')"
                    class="text-gray-500 hover:text-blue-600 p-4 inline-flex items-center gap-2 rounded-md"
                    :href="link.url ?? '#'">
                        <span class="sr-only">Next</span>
                        <span aria-hidden="true">»</span>
                </Link>
                <Link 
                    v-else
                    :class="link.active ? activeClass : defaultClass"
                    :href="link.url ?? '#'" v-html="link.label">
                </Link>
            </div>
        </nav>
    </div>
</template>