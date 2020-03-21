export default {
    template:`
    <div id="contactForm">
        <form action="./admin/sign-up.php" method="post" id="form">
            <h2>Subscription</h2>
            <p> {{ message }}</p>
            <div class="others">
            <input id="name" v-model="input.name" type="text" name="name" placeholder="Name">
            </div>
            <div id=genderAge>
            <select id="gender" v-model="input.gender" type="text" name="gender">
                <option disabled value="">Gender</option>
                <option value="male">Male</option>
                <option value="male">Female</option>
                <option value="prefer not to say">Prefer Not to Say</option>          
            </select>

            <select id="age" class="genderAge" v-model="input.age" type="text" name="age">
                    <option disabled value="">Age</option>
                    <option value="under 14">Under 14</option>
                    <option value="14-19">14-19</option>
                    <option value="20-30">20-30</option>
                    <option value="31-40">31-40</option>
                    <option value="41-50">41-50</option>
                    <option value="over50">Over 50</option>
                    <option value="prefer not to say">Prefer Not to Say</option>               
                </select>

            </div>
            <div id=others>
            <input id="email" v-model="input.email" type="email" name="email" placeholder="Email">

            <input id="message" v-model="input.message" type="text" name="message" placeholder="Message">
            </div>

            <button v-on:click.prevent="sign()" name="submit" type="submit">Submit</button>
            </form>
    </div>
    `,
    data(){
        return {
            input:{
                name:'',
                gender:'',
                age:'',
                email:'',
                message:''
            },
            result:'',
            message:''
        }
    },

    methods:{
        sign(){
            if(this.input.name != "" && this.input.gender != "" && this.input.age != "" && this.input.email != "" && this.input.message != "" ){
                var d = new Date();
                var now = d.getTimezoneOffset();

                let formData = new FormData();
                formData.append('name',this.input.name);
                formData.append('gender',this.input.gender);
                formData.append('age',this.input.age);
                formData.append('email',this.input.email);
                formData.append('message',this.input.message);
                formData.append('date',now);
 
                // let url = './admin/sign_up.php';

               
            }else{
               return this.message = "Please fill out the required field! ";
            }
        }
    } }
