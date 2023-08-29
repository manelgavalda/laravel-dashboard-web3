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
        :eth="eth"
    ></total-balance>
</template>

<script>
    export default {    
        props: ['tokens', 'networks'],
        data() {
            return { 
                total: 0,
                eth: 0
            }
        },
        methods: {
            updateTotals(total) {
                this.total += total

                this.eth = this.total / this.tokens['0xEeeeeEeeeEeEeeEeEeEeeEEEeeeeEeeeeeeeEEeE']['price']['usd'];
            }
        }
    }
</script>
