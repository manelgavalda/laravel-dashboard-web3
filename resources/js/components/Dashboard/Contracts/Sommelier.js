import { ethers } from 'ethers'

export default class Sommelier {
    ABI
    contract

    constructor(provider, address, ABI) {
        this.contract = new ethers.Contract(address, ABI, provider)
    }

    async getBalance(wallet) {
        const response = await this.makeRequest(wallet)
        
        const balance = response[0].balance
        
        return (await this.contract.convertToAssets(balance)).toNumber() / 1e8
    }

    async makeRequest (wallet) {
        const params = {
            userEthAddress: wallet,
            body: {
                "token": import.meta.env.VITE_SOMMELIER_POOL,
                "fields": [
                    "balance",
                    "updatedAt"
                ]
            },
        }
    
        const url = `https://api.rhino.fi/v1/trading/r/getBalanceForUser/${params.userEthAddress}`
    
        const response = await fetch(url, {
            method: "POST",
            body: JSON.stringify(params.body),
            headers: {
                "Accept": "application/json",
                "Content-Type": "application/json",
            },
        })
    
        return response.json()
    }

    getPrice(tokens) {
        return tokens['0xEeeeeEeeeEeEeeEeEeEeeEEEeeeeEeeeeeeeEEeE'].price.usd
    }

    getDecimals() {
        return 0
    }
}