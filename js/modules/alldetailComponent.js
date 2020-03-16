import DetailComponent from './detailComponent.js';

export default {
    template: `
    <div class="container">
        <detail v-for="(detail, index) in detailList" :details="detail" :key="index" />
    </div>
    `,

    created:function(){
        this.fetchAllContent();
    },

    data(){
        return {
            detailList:[]
        }
    },


    methods: {
        fetchAllContent(){
            let url ='./admin/admin_detail.php?allcontent=true';
            fetch(url)
            .then(res=>res.json())
            .then(data => this.detailList = data)
			.catch((error) => console.error(error))

        }
    },

    components:{
		detail:DetailComponent 
}

    
}
