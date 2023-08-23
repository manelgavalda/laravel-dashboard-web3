<template>
    <div class="col-span-full xl:col-span-6 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
        <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
            <h2 class="font-semibold text-slate-800 dark:text-slate-100">Tokens</h2>
        </header>
        <div class="p-3">

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="table-auto w-full dark:text-slate-300">
                    <!-- Table header -->
                    <thead class="text-xs uppercase text-slate-400 dark:text-slate-500 bg-slate-50 dark:bg-slate-700 dark:bg-opacity-50 rounded-sm">
                        <tr>
                            <th class="p-2">
                                <div class="font-semibold text-left">Name</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-center">Balance</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-center">Price</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-center">USD value</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-center">ETH value</div>
                            </th>
                        </tr>
                    </thead>
                    <!-- Table body -->
                    <tbody class="text-sm font-medium divide-y divide-slate-100 dark:divide-slate-700">
                        <!-- Row -->
                        <tr v-for="contract in parsedContracts">
                            <td class="p-2">
                                <div class="flex items-center">
                                    <svg width="24px" height="24px" viewBox="0 0 24 24" role="img" xmlns="http://www.w3.org/2000/svg">
                                        <title>Ethereum icon</title>
                                        <path d="M11.944 17.97L4.58 13.62 11.943 24l7.37-10.38-7.372 4.35h.003zM12.056 0L4.69 12.223l7.365 4.354 7.365-4.35L12.056 0z"/>
                                    </svg>
                                    <div class="text-slate-800 dark:text-slate-100 pl-1">{{ contract.name }}</div>
                                </div>
                            </td>
                            <td class="p-2">
                                <div class="text-center">0.004</div>
                            </td>
                            <td class="p-2">
                                <div class="text-center text-emerald-500">{{ $filters.currencyUSD(contract.price) }}</div>
                            </td>
                            <td class="p-2">
                                <div class="text-center text-emerald-700">$6.94</div>
                            </td>
                            <td class="p-2">
                                <div class="text-center text-sky-500">0.04</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['contracts'],
        data() {
            return { 
                parsedContracts: [] 
            }
        },
        mounted() {
            this.parsedContracts = JSON.parse(this.contracts)
        }
    }
</script>
