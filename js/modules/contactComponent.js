export default {
    props:['contactInfo'],

    template:`
    <div>
        <h2>{{ contactInfo.title }}</h2>
        <div id="contactInfo">
            <div class="contactInfo">
                <p>Address: {{ contactInfo.address }}</p>
            </div>

            <div class="contactInfo">
                <p>Phone: {{ contactInfo.phone }} </p>
            </div>

            <div class="contactInfo">
                <p>E-mail: {{ contactInfo.email }}</p>
            </div>

            <div class="contactInfo">
                <p>Website: {{ contactInfo.website }}</p>
            </div>
        </div> 

        <div id="tip">
            <img :src="'images/' + contactInfo.picture + '.png'" alt="contact picture">
        </div>

        <div id="copyright">
            <p>Copyright © {{ year }}</p>
        </div>
        <div id="snapchat">
        </div>
    </div>
        `        
        ,
     data(){
         return{
             year:''
         }
     },

     methods:{
         callFunction:function(){
             var currentDate = new Date();
             this.year = currentDate.getFullYear();
            
         }
     },

     mounted(){
         this.callFunction()
     }

}