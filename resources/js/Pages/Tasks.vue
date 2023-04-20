<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import CreateTask from "@/Pages/Task/CreateTask.vue";
import EditTask from "@/Pages/Task/EditTask.vue";


defineProps({
    tasks: {
        type: Array,
    }
});
</script>

<template>
    <Head title="Tasks" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tasks</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">

                        <CreateTask> </CreateTask>

                        <div v-for="task in tasks" class="bg-white shadow-md rounded-lg overflow-hidden mb-4">
                            <div class="p-4">
                                <slot name="header"> {{ task.title }}</slot>
                            </div>
                            <div class="px-4 py-2">
                                <slot>
                                    {{ task.description }}
                                    <br>
                                    {{ task.completed ? 'Done' : 'Pending' }}
                                </slot>
                            </div>
                            <div class="bg-gray-100 p-4">
                                <slot name="footer">
                                   <div class="flex justify-center">

                                       <EditTask
                                           :id="task.id"
                                           class="ml-4 mr-4"
                                           :task="task"
                                       ></EditTask>

                                       <PrimaryButton class="ml-4 mr-4">
                                           Mark Complete
                                       </PrimaryButton>

                                   </div>
                                </slot>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
