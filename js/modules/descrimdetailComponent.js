export default {
    // props: ['details'],
    template:`<div>
    <div class="detail-header">
        <div class="detail-header-image">
            <img :src="'images/' + details.header_image"
            :alt="details.header_image">   
        </div>
        <div class="detail-header-title">
            <h2 v-html="details.header"> {{ details.header }}</h2>
        </div>
    </div>
    <div class="detail-content">
        <div class="detail-intro">
            <div class="detail-intro-content">
                <p v-html="details.intro"> {{ details.intro }}</p>
            </div>
            <div class="detail-intro-img">
                <img :src="'images/' + details.image" :alt=" details.image ">
            </div>
        </div>

        <div class="detail-intro">
            <div class="detail-sub-img">
                <img :src="'images/' + details.sub_image "
                :alt=" details.sub_image">
            </div>
            <div class="detail-sub-content">
                <p v-html="details.sub_intro"></p>
            </div>
        </div>
    </div>
    </div>
    `,

    data: function () {
        return{
            details: {},
            
        }
    },

    created: function(){
        this.hivdetailContent();
    },

    methods:{
        hivdetailContent(){
            let url = `./admin/detail.php?category=descrimination`;
            fetch(url)
            .then(res => res.json())
            .then(data =>{
                this.details = data[0];
            })

        }
        }
}