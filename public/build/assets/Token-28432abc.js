var e=Object.defineProperty;var n=(r,t,a)=>t in r?e(r,t,{enumerable:!0,configurable:!0,writable:!0,value:a}):r[t]=a;var s=(r,t,a)=>(n(r,typeof t!="symbol"?t+"":t,a),a);import{C as i}from"./app-b9303b25.js";class l{constructor(t,a,c){s(this,"ABI");s(this,"address");this.address=a,this.contract=new i(a,c,t)}async getBalance(t){return await this.contract.balanceOf(t)}getPrice(t){return t[this.address].price.usd}async getDecimals(){return await this.contract.decimals()}}export{l as default};
