export default {
    template: `
    <div id="combineContainer">
    <!-- 0 DISCRIMINATION -->
    <div id="discrimination" class="combineSub">
        <div id="heart">
            <img :src="'images/' + descrimDetails.content_picture" alt="huge">
        </div>
        <div id="discriminationSub">
            <div class="textInfo">
                <h2 v-html="descrimDetails.content_header"></h2>
                <p v-html="descrimDetails.content_intro"></p>

                <div class="readmore"><a @click="descrimination">Read more...</a></div>

            </div>
        </div>
    </div>

    <!-- PREVENTION -->
    <div id="prevention" class="combineSub">
        <div id="preventionSub">
            <div class="textInfo">
            <h2 v-html="preventDetails.content_header"></h2>
            <p v-html="preventDetails.content_intro"></p>

                <div class="readmore"><a @click="prevention">Read more...</a></div>

            </div>
        </div>
        <div id="condom">
            <img :src="'images/' + preventDetails.content_picture" alt="condom">
        </div>
    </div>
    </div>
    `,
    
    data: function () {
        return{
            descrimDetails: {}, 
            preventDetails: {}, 
        }
    },

    created: function(){
        this.discrimContent();
        this.preventContent();
    },
        
    methods:{
        descrimination: function(){
            this.$router.replace({
                name: "descrimination"});
            },

        prevention: function(){
            this.$router.replace({
                name: "prevention"});
            },

        discrimContent(){
            let url = `./admin/content.php?filter=discrimination`;
            fetch(url)
            .then(res => res.json())
            .then(data =>{
                this.descrimDetails = data[0];
            })

        },

        preventContent(){
            let url = `./admin/content.php?filter=prevention`;
            fetch(url)
            .then(res => res.json())
            .then(data =>{
                this.preventDetails = data[0];
                // console.log( this.videoDetail);
            })
        }
        }

}