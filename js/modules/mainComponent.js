import homeComponent    from './homeComponent.js';
import introComponent   from './introComponent.js';
// import discriminationComponent   from './discriminationComponent.js';
// import preventionComponent   from './preventionComponent.js';
import ContactComponent from './contactComponent.js';
import MemberComponent  from './memberComponent.js';
import discrimPreventComponent from '/discrimPrevent.js';

export default {
    template: `
    <div id="vueroute">
       
        <homepage></homepage>

        <intro></intro>
        <discrimination></discrimination>
        <discrimPrevent></discrimPrevent>
        <prevent></prevent>
        <div id="contact">
            <div id="contactTitle">
                <div id="contactSub">
                    <div>
                    <h2>{{ subscription }}</h2>
                    </div>
                </div>
                <member></member>
            </div>

            <div id="contactDetail">
                <contact v-for="contact in contactList" :contactInfo="contact"/> 
            </div>
        </div>

    </div>
    `,

    created: function ()  {
        this.fetchContact();
    },

    data () {
        return {
            subscription: 'Want get more knowledge about HIV?',
            contactList: []
        }
    },

    methods:{
        fetchContact(){
            let url = './admin/admin_contact.php?contact=true';

            fetch(url)
            .then(res  => res.json())
            .then(data => this.contactList = data)
            .catch((error) => console.error(error))
        }
    },

        components:{
            homepage:homeComponent,
            contact:ContactComponent,
            member:MemberComponent ,
            intro:introComponent,
            // discrimination:discriminationComponent,
            // prevent:preventionComponent,
            discrimPrevent:discrimPreventComponent,
        }
}