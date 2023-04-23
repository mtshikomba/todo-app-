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

const editingTask = ref(false);
const titleInput = ref(null);

const props = defineProps({
    task: null
});

const form = useForm({
    title: props.task.title,
    description: props.task.description,
    completed: props.task.completed
});

const editTask = () => {
    editingTask.value = true;

    nextTick(() => titleInput.value.focus());
};

const updateTask = () => {
    console.log(props.task);
    form.put(route('tasks.update', props.task.id ), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => titleInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    console.log('test')
    editingTask.value = false;

    form.reset();
};

const checked = () => {
    return props.task.completed === 0 ? false : true;
}

</script>

<template>
    <section class="space-y-6">

        <PrimaryButton @click="editTask">Edit Task</PrimaryButton>

        <Modal :show="editingTask" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    Update Task Information
                </h2>

                <div class="mt-6">
                    <InputLabel for="title" value="Title" class="sr-only" />

                    <TextInput
                        id="title"
                        ref="titleInput"
                        v-model="form.title"
                        type="text"
                        class="mt-1 block w-3/4"
                        placeholder="Task Title..."
                    />

                    <InputError :message="form.errors.title" class="mt-2" />
                </div>

                <div class="mt-6">
                    <InputLabel for="description" value="Description" class="sr-only" />

                    <TextInput
                        id="description"
                        ref="descriptionInput"
                        v-model="form.description"
                        type="text"
                        class="mt-1 block w-3/4"
                        placeholder="Task Description..."
                    />

                    <InputError :message="form.errors.description" class="mt-2" />
                </div>

                <div class="mt-6">
                    <InputLabel for="complete" value="Completed" class="sr-only" />

                    Completed: <Checkbox
                        id="completed"
                        name="completed"
                        v-model="checked"
                        checked
                    />

                </div>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

                    <PrimaryButton
                        class="ml-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="updateTask"
                    >
                        Update Task
                    </PrimaryButton>

                </div>
            </div>
        </Modal>
    </section>
</template>
