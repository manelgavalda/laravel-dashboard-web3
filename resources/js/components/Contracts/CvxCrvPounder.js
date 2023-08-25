import axios from 'axios'
import { ethers } from 'ethers'

export default class CvxCrvPounderPool {
    contract
    ABI

    constructor(provider, address, ABI) {
        this.contract = new ethers.Contract(address, ABI, provider)
    }

    async getBalance(wallet) {
        return fetch('https://raw.githubusercontent.com/Llama-Airforce/Llama-Airforce-Airdrops/master/ucrv/latest.json')
            .then(response => response.json())
            .then(data => {
                const addresses = data.claims;

                const key = Object.keys(addresses).find(key => key.toLowerCase() === wallet.toLowerCase());

                return addresses[key].amount;
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    async getPrice(tokens) {
        return tokens[await this.contract.underlying()].price.usd
    }
    
    getDecimals() {
        return 18
    }
}