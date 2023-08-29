import { ethers } from 'ethers'

export default class LockedCvx {
    ABI
    contract

    constructor(provider, address, ABI) {
        this.contract = new ethers.Contract(address, ABI, provider)
    }

    async getBalance(wallet) {
        return (await this.contract.balanceOf(wallet))
    }

    async getPrice(tokens) {
        return tokens['0x4e3FBD56CD56c3e72c1403e103b45Db9da5B9D2B'].price.usd
    }

    getDecimals() {
        return 18
    }
}