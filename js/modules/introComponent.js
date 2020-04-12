import hivSubComponent    from './hivSubComponent.js';

export default {
    template: `
    <!-- HIV / AIDS -->
    <div id="HIV" class="subContainer">
        <div class="HIVsub">
            <div class="textInfo">
                <h2>What is HIV/AIDS?<br>What is different?</h2>
                <p>HIV is a virus that damages the immune system.<br><br>
                    To develop AIDS, a person has to have contracted HIV. But having HIV doesn’t necessarily mean that someone will develop AIDS.
                    <br>
                </p>


                <div class="readmore"><a href="./readmore.php">Read more...</a></div>

            </div>
        </div>
        <hivsub></hivsub>
    </div>

    

    
    `,


        

        components:{
            hivsub:hivSubComponent,
        },


}