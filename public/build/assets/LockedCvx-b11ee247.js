var n=Object.defineProperty;var s=(a,t,c)=>t in a?n(a,t,{enumerable:!0,configurable:!0,writable:!0,value:c}):a[t]=c;var e=(a,t,c)=>(s(a,typeof t!="symbol"?t+"":t,c),c);import{C as o}from"./app-b9303b25.js";class l{constructor(t,c,r){e(this,"ABI");e(this,"contract");this.contract=new o(c,r,t)}async getBalance(t){return await this.contract.balanceOf(t)}async getPrice(t){return t["0x4e3FBD56CD56c3e72c1403e103b45Db9da5B9D2B"].price.usd}getDecimals(){return 18}}export{l as default};
