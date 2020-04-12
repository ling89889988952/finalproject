export default {
    template: `
    <div id="index" class="subContainer">
        <div id="video">
            <video controls>
                <source :src="'video/'+ videoDetail.video_source" :key="videoDetail.video_source" type="video/mp4" autoplay control>
            </video>
        </div>
        <div id="title">
            <div id="indexSub">
                <h2>{{ homeDetails.home_header }}</h2>
                <h3>{{ homeDetails.home_subheader }}</h3>
                <p v-html="homeDetails.home_introduce"></p>
            </div>
        </div>
    </div>
    `,
    data: function () {
        return{
            homeDetails: {},
            videoDetail: {},
        }
    },

    created: function(){
        this.homeContent();
        this.videoContent();
    },

    methods:{
        homeContent(){
            let url = `./admin/home.php?page=home`;
            fetch(url)
            .then(res => res.json())
            .then(data =>{
                this.homeDetails = data;
            })

        },

        videoContent(){
            let url = `./admin/video.php?filter=home`;
            fetch(url)
            .then(res => res.json())
            .then(data =>{
                this.videoDetail = data[0];
                // console.log( this.videoDetail);
            })
        }
        }
    }
