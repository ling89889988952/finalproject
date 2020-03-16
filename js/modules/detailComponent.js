export default {
    props: ['details'],

    template:`<div class="details.page">
    <div class="detail-header">
        <div class="detail-header-image">
        <img src="images/'details.header_image'" alt="">   
        </div>
        <div class="detail-header-title">
            <h2> {{ details.header }}</h2>
        </div>
    </div>
    <div class="detail-content">
        <div class="detail-intro">
            <div class="detail-intro-content">
                <p> {{ details.intro }}</p>
            </div>
            <div class="detail-intro-img">
                <img src="images/'details.image'" alt="">
            </div>
        </div>

        <div class="detail-intro">
            <div class="detail-sub-img">
                <img src="images/'details.sub_image'" alt="">
            </div>
            <div class="detail-sub-content">
                <p>{{ details.sub_intro }} </p>
            </div>
        </div>
    </div>
    </div>
    `,
}