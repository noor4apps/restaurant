<script>
import BreezeAuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link} from '@inertiajs/inertia-vue3';

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Link,
    },
    props: {
        model: {
            type: Object,
            required: true,
        },
        errors: Object,
        flash: Object,
    },
    data() {
        return {
            form: {
                id: null,
                name: null,
                type: null,
                menu_id: null,
                price: null,
            },
        }
    },
    created() {
        if (!this.model.menu) {
            return;
        }
        this.form = {
            id: this.model.menu.id,
            name: this.model.menu.name,
            type: this.model.menu.type,
            menu_id: this.model.menu.menu?.id,
            price: this.model.menu.price,
        }
    },
    methods: {
        submit() {
            if (this.model.menu) {
                this.$inertia.put(`/menus/${this.model.menu.id}`, this.form)
            } else {
                this.$inertia.post('/menus', this.form)
            }
        },
    },
}
</script>

<template>
    <Head title="New Menus" />
    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                New Menus
            </h2>
        </template>
        <div v-if="flash.message" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert" id="alert-message">
            <span class="block sm:inline">{{ flash.message }}</span>
        </div>

        <div class="py-12 max-w-7xl">
            <form class="w-full max-w-lg mx-auto" @submit.prevent="submit">
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                            Name
                        </label>
                        <input v-model="form.name" class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="name" type="text">
                        <div v-if="errors.name" class="text-red-600 text-xs">{{ errors.name }}</div>
                    </div>
                    <div class="w-full md:w-1/3 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="type">
                            Type
                        </label>
                        <select v-model="form.type" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="type">
                            <option value="category">Category</option>
                            <option value="item">Item</option>
                        </select>
                        <div v-if="errors.type" class="text-red-600 text-xs">{{ errors.type }}</div>
                    </div>
                    <div class="w-full md:w-1/3 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="category">
                            Category
                        </label>
                        <select v-model="form.menu_id" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="category">
                            <option :value="menu.id" v-for="menu in model.menus" :key="menu.id">{{ menu.name }}</option>
                        </select>
                        <div v-if="errors.menu_id" class="text-red-600 text-xs">{{ errors.menu_id }}</div>
                    </div>
                    <div class="w-full md:w-1/3 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="price">
                            Price
                        </label>
                        <input v-model="form.price" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="price" type="number" min="1">
                        <div v-if="errors.price" class="text-red-600 text-xs">{{ errors.price }}</div>
                    </div>
                </div>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Save
                </button>
                <Link href="/menus" class="text-indigo-600 ml-4">
                    Cancel
                </Link>
            </form>
        </div>
    </BreezeAuthenticatedLayout>
</template>
