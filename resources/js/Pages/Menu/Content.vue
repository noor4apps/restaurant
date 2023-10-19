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
                coupon_id: null,
            },
        }
    },
    methods: {
        submit() {
            this.$inertia.patch(`/menus/${this.model.menu.id}/coupons/${this.form.coupon_id}/apply`)
        },
    },
}
</script>

<template>
    <Head title="New Menus"/>
    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ model.menu.name }}
            </h2>
        </template>
        <div v-if="flash.message" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert" id="alert-message">
            <span class="block sm:inline">{{ flash.message }}</span>
        </div>
        <div class="py-12 max-w-7xl">
            <div class="sm:px-6 lg:px-8 flex mb-10">
                <div class="p-6 w-1/4 bg-white max-w-sm mx-auto shadow-md">
                    <p class="text-gray-500">Name</p>
                    <div class="text-xl font-medium text-black">{{ model.menu.name }}</div>
                </div>
                <div class="p-6 w-1/4 bg-white max-w-sm mx-auto shadow-md">
                    <p class="text-gray-500">Type</p>
                    <div class="text-xl font-medium text-black">{{ model.menu.type }}</div>
                </div>
                <div class="p-6 w-1/4 bg-white max-w-sm mx-auto shadow-md">
                    <p class="text-gray-500">Price</p>
                    <div class="text-xl font-medium text-black">{{ model.menu.price }}</div>
                </div>
                <div class="p-6 w-1/4 bg-white max-w-sm mx-auto shadow-md">
                    <p class="text-gray-500">Discounted Price</p>
                    <div class="text-xl font-medium text-black">{{ model.menu?.discounted_price }}</div>
                </div>
            </div>
            <div class="sm:px-6 lg:px-8 flex mb-10">
                <form class="w-full max-w-lg mx-auto" @submit.prevent="submit">
                    <div class="w-full mb-6">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="category">
                            Coupon
                        </label>
                        <select v-model="form.coupon_id" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="category" required>
                            <option :value="coupon.id" v-for="coupon in model.coupons" :key="coupon.id">{{ coupon.code }}</option>
                        </select>
                    </div>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Apply
                    </button>
                    <Link href="/menus" class="text-indigo-600 ml-4">
                        Cancel
                    </Link>
                </form>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
