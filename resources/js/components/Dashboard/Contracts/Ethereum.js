export default class Ethereum {
    address
    provider

    constructor(provider, address) {
        this.address = address
        this.provider = provider
    }

    async getBalance(wallet) {
        return await this.provider.getBalance(wallet)
    }

    getDecimals() {
        return 18
    }

    getPrice(tokens) {
        return tokens[this.address].price.usd
    }
}