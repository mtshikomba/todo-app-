<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';
import Checkbox from "@/Components/Checkbox.vue";

const creatingTask = ref(false);
const titleInput = ref(null);


const form = useForm({
    title: null,
    description: null,
    completed: false
});

const createTask = () => {
    creatingTask.value = true;

    nextTick(() => titleInput.value.focus());
};

const storeTask = () => {
    form.post(route('tasks.store'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => titleInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    creatingTask.value = false;

    form.reset();
};

</script>

<template>
    <section class="space-y-6">

        <PrimaryButton
            @click="createTask"
            class="m-4"
        >Add Task</PrimaryButton>

        <Modal :show="creatingTask" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    Task Information
                </h2>

                <div class="mt-6">
                    <InputLabel for="title" value="Title" class="sr-only" />

                    <TextInput
                        id="title"
                        ref="titleInput"
                        v-model="form.title"
                        type="text"
                        class="mt-1 block w-3/4"
                        placeholder="Task Title"
                    />

                    <InputError :message="form.errors.title" class="mt-2" />
                </div>

                <div class="mt-6">
                    <InputLabel for="description" value="Description" class="sr-only" />

                    <TextInput
                        id="description"
                        v-model="form.description"
                        type="text"
                        class="mt-1 block w-3/4"
                        placeholder="Task Description"
                    />

                    <InputError :message="form.errors.description" class="mt-2" />
                </div>

                <div class="mt-6">
                    <InputLabel for="completed" value="Completed" class="sr-only" />

                    Completed Status: <Checkbox
                        id="completed"
                        checked=false
                        v-model="form.completed"
                    />

                </div>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

                    <PrimaryButton
                        class="ml-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="storeTask"
                    >
                        Create Task
                    </PrimaryButton>

                </div>
            </div>
        </Modal>
    </section>
</template>
