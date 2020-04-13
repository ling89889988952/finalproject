// import hivSubComponent    from './hivSubComponent.js';

export default {
    template: `
    <!-- HIV / AIDS -->
    <div id="HIV" class="subContainer">
        <div class="HIVsub">
            <div class="textInfo">
                <h2 v-html="introDetails.hiv_header"></h2>
                <p v-html="introDetails.hiv_detail"></p>


                <div class="readmore"><a @click="hiv">Read more...</a></div>

            </div>
        </div>
                <div class="HIVsub" id="HIVrightBlock">
            <div id="hiv">
                <div id="hivIntro" class="intro">
                    <div>
                        <p>{{ introDetails.hiv_intro }}</p>
                    </div>
                </div>
                <div id="hivPic">
                    <img v-if="true" :src="'images/' + introDetails.hiv_picture" alt="virus">
                    <video v-if="false" controls>
                <source :src="'video/'+ videoDetail.video_source" :key="videoDetail.video_source" type="video/mp4" autoplay control>
            </video>
                </div>
                
            </div>
            <div id="aids">
                <div id="aidsPic">
                    <img :src="'images/' + introDetails.aid_picture" alt="DNA">
                </div>
                <div id="aidsIntro" class="intro">
                    <div>
                        <p>{{ introDetails.aid_intro }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

    
    `,

    readmore:function(){
        this.$router.replace({name: ""})
    },
    data: function () {
        return{
            introDetails: {}, 
            videoDetail: {}, 
        }
    },

    created: function(){
        this.introContent();
        this.videoContent();
    },
        
    methods:{
        hiv: function(){
        this.$router.replace({
            name: "hiv"});
        },

        introContent(){
            let url = `./admin/home.php?page=hiv`;
            fetch(url)
            .then(res => res.json())
            .then(data =>{
                this.introDetails = data;
            })

        },

        videoContent(){
            let url = `./admin/video.php?filter=hiv`;
            fetch(url)
            .then(res => res.json())
            .then(data =>{
                this.videoDetail = data[0, 1];
                // console.log( this.videoDetail);
            })
        }
        }

        // components:{
        //     hivsub:hivSubComponent,
        // },


}