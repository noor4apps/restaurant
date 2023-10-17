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
        edit(menu) {
            this.$inertia.get(`menus/${menu.id}/edit`);
        },
        async remove(menu) {
            this.$inertia.delete(`menus/${menu.id}`);
        },
    }
}
</script>

<template>
    <Head title="All Menus" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Menus
            </h2>
            <Link href="/menus/create" as="button" type="button" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded mt-2">
                New Menus
            </Link>
        </template>
        <div class="py-12 max-w-7xl">
            <table class="min-w-full divide-y divide-gray-200 mx-16">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Type
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Price
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Discounted Price
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Parent Menu
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Discount code
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 overflow-y-scroll">
                <tr v-for="menu in model.menus" :key="menu.id" class="hover:bg-gray-100">
                    <td class="px-6 py-4 hover:cursor-pointer" @click="edit(menu)">
                        <div class="text-sm text-gray-900">{{ menu.name }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">{{ menu.type }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">{{ menu.price }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">{{ menu.discounted_price }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">{{ menu.menu?.name }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">{{ menu.coupon?.code }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <button @click="remove(menu)" class="bg-transparent hover:bg-red-500 text-red-700 hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded" type="button">
                            Remove
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </BreezeAuthenticatedLayout>
</template>
