import { ethers } from 'ethers'

export default class Token {
    ABI
    address

    constructor(provider, address, ABI) {
        this.address = address
        this.contract = new ethers.Contract(address, ABI, provider)
    }

    async getBalance(wallet) {
        return await this.contract.balanceOf(wallet)
    }

    getPrice(tokens) {
        return tokens[this.address].price.usd
    }

    async getDecimals() {
        return await this.contract.decimals()
    }
}