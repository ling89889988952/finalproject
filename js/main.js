

import homeComponent from "./modules/homeComponent.js";
import contactComponent from "./modules/contactComponen.js"



// these are the same as Express route -> route.get('/',..do something with the request)
const routes = [
    { path: '/', name:'home',component:homeComponent},
    { path: '/contact', name:'contact',component:contactComponent}
   

]

const router = new VueRouter({
    routes // short for routes: routes
})



const vm = new Vue({
    data:{

    },

    methods:{

    },

    router
}).$mount("#app");