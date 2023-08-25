<template>
    <template class="grid grid-cols-12 gap-6" v-for="(contracts, network) in networks">
        <token-balances
            @total-updated="updateTotals"
            :contracts="contracts" 
            :network="network" 
            :tokens="tokens"
        ></token-balances>
    </template>

    <total-balance
        :total="total"
    ></total-balance>
</template>

<script>
    export default {    
        props: ['tokens', 'networks'],
        data() {
            return { 
                total: 0,
            }
        },
        methods: {
            updateTotals(total) {
                this.total += total
            }
        }
    }
</script>
