<script>
import BreezeAuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import {Head, Link} from "@inertiajs/inertia-vue3";

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
    },
    methods: {
        edit(coupon) {
            this.$inertia.get(`coupons/${coupon.id}/edit`);
        },
        async remove(coupon) {
            this.$inertia.delete(`coupons/${coupon.id}`);
        },
    }
}
</script>

<template>
    <Head title="All Coupons" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Coupons
            </h2>
            <Link href="/coupons/create" as="button" type="button" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded mt-2">
                New Coupons
            </Link>
        </template>
        <div class="py-12 max-w-7xl">
            <table class="min-w-full divide-y divide-gray-200 mx-16">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Code
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Type
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Discount
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 overflow-y-scroll">
                <tr v-for="coupon in model.coupons" :key="coupon.id" class="hover:bg-gray-100">
                    <td class="px-6 py-4 hover:cursor-pointer" @click="edit(coupon)">
                        <div class="text-sm text-gray-900">{{ coupon.code }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">{{ coupon.type }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">{{ coupon.discount }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <button @click="remove(coupon)" class="bg-transparent hover:bg-red-500 text-red-700 hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded" type="button">
                            Remove
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </BreezeAuthenticatedLayout>
</template>
