<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import ActionMessage from '@/Components/ActionMessage.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import TextareaInput from '@/Components/TextareaInput.vue';

const props = defineProps({
    product: Object
});

const form = useForm({
    _method: 'PUT',
    name: props.product.name,
    sku: props.product.sku.toString(),
    description: props.product.description,
    specification: props.product.specification,
    photo: null,
});

const photoPreview = ref(null);
const photoInput = ref(null);

const updateProduct = () => {
    if (photoInput.value) {
        form.photo = photoInput.value.files[0];
    }

    form.post(route('products.update', props.product ), {
        errorBag: 'updateProduct',
        preserveScroll: true
    });
};

const selectNewPhoto = () => {
    photoInput.value.click();
};

const updatePhotoPreview = () => {
    const photo = photoInput.value.files[0];

    if (! photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);
};
</script>

<template>
    <FormSection @submitted="updateProduct">
        <template #title>
            Product Details
        </template>

        <template #description>
            Edit product.
        </template>

        <template #form>
            <!-- Photo -->
            <div class="col-span-6 sm:col-span-4">
                <!-- Photo File Input -->
                <input
                    ref="photoInput"
                    type="file"
                    class="hidden"
                    @change="updatePhotoPreview"
                >

                <InputLabel for="photo" value="Photo" />

                <!-- New Photo Preview -->
                <div v-show="photoPreview" class="mt-2">
                    <span
                        class="block aspect-video w-48 rounded-lg bg-cover bg-no-repeat bg-center"
                        :style="'background-image: url(\'' + photoPreview + '\');'"
                    />
                </div>

                <SecondaryButton class="mt-2 mr-2" type="button" @click.prevent="selectNewPhoto">
                    Select A New Photo
                </SecondaryButton>

                <InputError :message="form.errors.photo" class="mt-2" />
            </div>
            
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="name" value="Product Name" />
                <TextInput
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="block w-full mt-1"
                    autofocus
                />
                <InputError :message="form.errors.name" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="sku" value="Item SKU" />
                <TextInput
                    id="sku"
                    v-model="form.sku"
                    type="number"
                    class="block w-full mt-1"
                    autofocus
                />
                <InputError :message="form.errors.sku" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="description" value="Product Description" />
                <TextareaInput
                    id="description"
                    v-model="form.description"
                    type="text"
                    class="block w-full mt-1"
                    autofocus
                />
                <InputError :message="form.errors.description" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="specification" value="Product Specification" />
                <TextareaInput
                    id="specification"
                    v-model="form.specification"
                    type="text"
                    class="block w-full mt-1"
                    autofocus
                />
                <InputError :message="form.errors.specification" class="mt-2" />
            </div>
        </template>

        <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </ActionMessage>

            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Update
            </PrimaryButton>
        </template>
    </FormSection>
</template>
