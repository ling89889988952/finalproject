import mainComponent from "./modules/mainComponent.js";
import hivdetailComponent from "./modules/hivdetailComponent.js";
import discrimdetailComponent from "./modules/descrimdetailComponent.js";
import preventdetailComponent from "./modules/preventdetailComponent.js";

    

(() =>{

    let router  = new VueRouter ({
        routes: [
            { path: '/', name:'main',component:mainComponent},
            { path: '/hiv', name:'hiv',component:hivdetailComponent},
            { path: '/descrimination', name:'descrimination',component:discrimdetailComponent},
            { path: '/prevention', name:'prevention',component:preventdetailComponent},
        ]
    });

    const vm = new Vue({

    router: router 
}).$mount("#app");

})();
