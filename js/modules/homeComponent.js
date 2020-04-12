export default {
    template: `
    <div id="index" class="subContainer">
        <div id="video">
            <video controls>
                <source :src="'video/'+ homeDetails.home_video" :key="homeDetails.home_video" type="video/mp4" autoplay control>
            </video>
        </div>
        <div id="title">
            <div id="indexSub">
                <h2>{{ homeDetails.home_header }}</h2>
                <p><br>HIV is not something that “guilty” people get. It is not a punishment for cheating, lying, using drugs or alcohol, having more than one partner, or not asking the right questions. 
                    <br><br><br>
                    <span>-POSITIVE WOMEN'S NETWORK OF THE UNITED STATES OF AMERICA</span>
                </p>
            </div>
        </div>
    </div>
    `,
    data: function () {
        return{
            homeDetails: {},
        }
    },

    created: function(){
        this.homeContent();
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
        }
    }
