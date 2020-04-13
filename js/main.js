import mainComponent from "./modules/mainComponent.js";
import detailComponent from "./modules/alldetailComponent.js";

    

(() =>{

    let router  = new VueRouter ({
        routes: [
            { path: '/', name:'main',component:mainComponent},
            { path: '/read', name:'read',component:detailComponent},
        ]
    });

    const vm = new Vue({

    router: router 
}).$mount("#app");

})();
