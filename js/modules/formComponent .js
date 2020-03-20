export default {
    template:`
    <div id="contactForm">
        <form action="sign-up.php" method="post" id="form">
            <h2>{{ formTitle }}</h2>
            <div class="others">
                <input id="name" v-model="name" type="text" name="name" placeholder="Name">
            </div>
            <div id=genderAge>
                <input id="gender" class="genderAge" v-model="gender" type="text" name="gender" placeholder="Gender">
                <input id="age" class="genderAge" v-model="age" type="text" name="age" placeholder="Age">
            </div>
            <div id=others>
                <input id="email" v-model="email" type="email" name="email" placeholder="Email">
                <input id="message" v-model="message" type="text" name="message" placeholder="Message">
            </div>
            <button name="submit">Submit</button>
        /form>
    </div>
    
    `,
    data(){
        return{
            formTitle:'Subscription',
        }
    }
}
