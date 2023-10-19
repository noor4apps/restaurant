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
    },
    data() {
        return {
            form: {
                id: null,
                code: null,
                type: null,
                discount: null,
            }
        }
    },
    created() {
        if (!this.model.coupon) {
            return;
        }
        this.form = {
            id: this.model.coupon.id,
            code: this.model.coupon.code,
            type: this.model.coupon.type,
            discount: this.model.coupon.discount,
        }
    },
    methods: {
        submit() {
            if (this.model.coupons) {
                this.$inertia.put(`/coupons/${this.model.coupon.id}`, this.form)
            } else {
                this.$inertia.post('/coupons', this.form)
            }
        },
    },
}
</script>

<template>
    <Head title="New Coupon" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                New Coupon
            </h2>
        </template>
        <div class="py-12 max-w-7xl">
            <form class="w-full max-w-lg mx-auto" @submit.prevent="submit">
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="code">
                            Code
                        </label>
                        <input v-model="form.code" class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="code" type="text">
                        <div v-if="errors.code" class="text-red-600 text-xs">{{ errors.code }}</div>
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
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="discount">
                            Discount
                        </label>
                        <input v-model="form.discount" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="discount" type="number" min="1">
                        <div v-if="errors.discount" class="text-red-600 text-xs">{{ errors.discount }}</div>
                    </div>
                </div>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Save
                </button>
                <Link href="/coupons" class="text-indigo-600 ml-4">
                    Cancel
                </Link>
            </form>
        </div>
    </BreezeAuthenticatedLayout>
</template>
