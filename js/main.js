import homeComponent from "./modules/homeComponent.js";
import readComponent from "./modules/readComponent.js";

(() =>{

    let router  = new VueRouter ({
        routes: [
            { path: '/', name:'home',component:homeComponent},
            { path: '/read', name: 'read',component:readComponent},
        ]
    });

    const vm = new Vue({

    router: router 
}).$mount("#app");

})();
